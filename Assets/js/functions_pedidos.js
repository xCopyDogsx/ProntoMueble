tablePedidos = $('#tablePedidos').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax":{
        "url": " "+base_url+"/Pedidos/getPedidos",
        "dataSrc":""
    },
    "columns":[
        {"data":"Ped_ID"},
        {"data":"transaccion"},
        {"data":"fecha"},
        {"data":"Ped_Total"},
        {"data":"Pag_Nom"},
        {"data":"Ped_Status"},
        {"data":"options"}
    ],
    "columnDefs": [
                    { 'className': "textcenter", "targets": [ 3 ] },
                    { 'className': "textright", "targets": [ 4 ] },
                    { 'className': "textcenter", "targets": [ 5 ] }
                  ],       
    'dom': 'lBfrtip',
    'buttons': [
        {
            "extend": "copyHtml5",
            "text": "<i class='far fa-copy'></i> Copiar",
            "titleAttr":"Copiar",
            "className": "btn btn-secondary",
            "exportOptions": { 
                "columns": [ 0, 1, 2, 3, 4, 5] 
            }
        },{
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr":"Exportar a Excel",
            "className": "btn btn-success",
            "exportOptions": { 
                "columns": [ 0, 1, 2, 3, 4, 5] 
            }
        },{
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr":"Exportar a PDF",
            "className": "btn btn-danger",
            "exportOptions": { 
                "columns": [ 0, 1, 2, 3, 4, 5] 
            }
        },{
            "extend": "csvHtml5",
            "text": "<i class='fas fa-file-csv'></i> CSV",
            "titleAttr":"Exportar a CSV",
            "className": "btn btn-info",
            "exportOptions": { 
                "columns": [ 0, 1, 2, 3, 4, 5] 
            }
        }
    ],
    "responsive":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"asc"]]  
});
function fntTransaccion(idtransaccion){
    let request=(window.XMLHttpRequest)?
                new XMLHttpRequest():
                new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Pedidos/getTransaccion/'+idtransaccion;
    divLoading.style.display="flex";
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange=function(){
        if(request.readyState ==4 && request.status==200){
            let objData = JSON.parse(request.responseText);
            if(objData.status){
                document.querySelector("#divModal").innerHTML=objData.html;
                divLoading.style.display="none";
                $('#modalReembolso').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
                
}
function fntReembolsar(){
    let idTransaccion=document.querySelector("#idtransaccion").value;
    let observacion=document.querySelector("#txtObservacion").value;
    if(idTransaccion==''||observacion==''){
        swal("","Complete todos los campos.","error");
        return false;
    }
    swal({
        title: "Iniciar proceso",
        text: "¿Realmente quiere realizar el proceso de reembolso?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: true,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) 
        {
             $('#modalReembolso').modal('hide');
             divLoading.style.display="flex";
             let request=(window.XMLHttpRequest)?
                new XMLHttpRequest():
                new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Pedidos/setReembolso/';
            let formData = new FormData();
            formData.append('idtransaccion',idTransaccion);
            formData.append('observacion',observacion);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange=function(){
                 if(request.readyState !=4)return; 
                    if(request.status==200){
                       let objData=JSON.parse(request.responseText);
                       if(objData.status){
                        window.location.reload();
                       }else{
                        swal("Error",objData.msg,"error");
                       }
                       divLoading.style.display="none";
                       return false;
                 }
            }
        }
    });
}
function fntDelInfo(idpedido){
    swal({
        title: "Eliminar pedido",
        text: "¿Realmente quiere eliminar este pedido?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Pedidos/delPedido';
            let strData = "idPedido="+idpedido;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar", objData.msg , "success");
                        tablePedidos.api().ajax.reload();
                    }else{
                        swal("Atención", objData.msg , "error");
                    }
                }
            }
        }

    });
}