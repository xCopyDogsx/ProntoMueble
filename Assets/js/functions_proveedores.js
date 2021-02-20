let tableProveedores; 
let rowTable = "";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){

    tableProveedores = $('#tableProveedores').dataTable(     {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Proveedores/getProveedores",
            "dataSrc":""
        },
        "columns":[
            {"data":"Prov_ID"},
            {"data":"Prov_Nom"},
            {"data":"Prov_Dir"},
            {"data":"Prov_Fijo"},
            {"data":"Prov_Email"},
            {"data":"Prov_Status"},
            {"data":"options"}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Exportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Exportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "responsive":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });
window.addEventListener('load', function() {
    if(document.querySelector("#formProveedores")){
        let formProveedores = document.querySelector("#formProveedores");
        formProveedores.onsubmit = function(e) {
            e.preventDefault();
            let strNombre = document.querySelector('#txtNombre').value;
            let strDireccion = document.querySelector('#txtDireccion').value;
            let strFijo = document.querySelector('#txtFijo').value;
            let strCelular = document.querySelector('#txtCelular').value;
            let strContacto  = document.querySelector('#txtContacto').value;
            let strEmail  = document.querySelector('#txtEmail').value;
            let intStatus = document.querySelector('#listStatus').value;
            if(strNombre == '' || strDireccion == '' || strFijo == '' || strCelular == '' ||strContacto==''||strEmail=='')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }
            divLoading.style.display = "flex";
            tinyMCE.triggerSave();
            let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Proveedores/setProveedor'; 
            let formData = new FormData(formProveedores);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("", objData.msg ,"success");
                        document.querySelector("#idProveedor").value = objData.Prov_ID;

                        if(rowTable == ""){
                            tableProveedores.api().ajax.reload();
                        }else{
                           htmlStatus = intStatus == 1 ? 
                            '<span class="badge badge-success">Activo</span>' : 
                            '<span class="badge badge-danger">Inactivo</span>';
                            rowTable.cells[1].textContent = strNombre;
                            rowTable.cells[2].textContent = strDireccion;
                            rowTable.cells[3].textContent = strEmail;
                            rowTable.cells[4].textContent = strFijo;
                            rowTable.cells[5].innerHTML =  htmlStatus;
                            rowTable = ""; 
                        }
                        $('#modalFormProveedores').modal("hide");
                        formProveedores.reset();
                        swal("", objData.msg ,"success");
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
          }
        }
    });
    }, false);


function fntEditInfo(element,idProveedor){
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML ="Actualizar Producto";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Proveedores/getProveedor/'+idProveedor;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let htmlImage = "";
                let objProducto = objData.data;
                document.querySelector("#idProveedor").value = objProducto.Prov_ID;
                document.querySelector("#txtNombre").value = objProducto.Prov_Nom;
                document.querySelector("#txtDireccion").value = objProducto.Prov_Dir;
                document.querySelector("#txtFijo").value = objProducto.Prov_Fijo;
                document.querySelector("#txtCelular").value = objProducto.Prov_Cel;
                document.querySelector("#txtContacto").value = objProducto.Prov_Contacto;
                document.querySelector("#txtEmail").value = objProducto.Prov_Email;
                document.querySelector("#listStatus").value = objProducto.Prov_Status;
                //tinymce.activeEditor.setContent(objProducto.Prod_Desc); 
               // fntBarcode();      
                $('#modalFormProveedores').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}
function openModal()
{
    rowTable = "";
    document.querySelector('#idProveedor').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Proveedor";
    document.querySelector("#formProveedores").reset();
    $('#modalFormProveedores').modal('show');

}

function fntDelInfo(idProveedor){
    swal({
        title: "Eliminar Proveedor",
        text: "¿Realmente quiere eliminar el proveedor?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Proveedores/delProveedor   ';
            let strData = "idProveedor="+idProveedor;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableProveedores.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}

function fntViewInfo(idProducto){
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Proveedores/getProveedor/'+idProducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    /*let ajaxUrlx = base_url+'/Proveedores/getEspecial/'+idProducto;
    request.open("GET",ajaxUrlx,true);
    request.send();*/
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
           // let objDat =  JSON.parse(request.responseText);
            if(objData.status)
            {
                let htmlImage = "";
                let objProducto = objData.data;
              //  let obj = objDat.data;
                let estadoProducto = objProducto.Prov_Status == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celNombre").innerHTML = objProducto.Prov_Nom;
                document.querySelector("#celFijo").innerHTML = objProducto.Prov_Fijo;
                document.querySelector("#celCel").innerHTML = objProducto.Prov_Cel;
                document.querySelector("#celOficina").innerHTML = objProducto.Prov_Dir;
                document.querySelector("#celContacto").innerHTML = objProducto.Prov_Contacto;
                document.querySelector("#celStatus").innerHTML = estadoProducto;
                document.querySelector("#celEmail").innerHTML = objProducto.Prov_Email;
                if(typeof objProducto[0].Cat_Nom=='undefined'){
                    document.querySelector("#celCat").innerHTML = 'No reporta ninguna categoria por el momento.';
                }else{
                  document.querySelector("#celCat").innerHTML = objProducto[0].Cat_Nom;  
                }
                if(typeof objProducto[1].Env_Cant=='undefined'){
                    document.querySelector("#celCant").innerHTML = 'No reporta ninguna envio por el momento.';
                }else{
                   document.querySelector("#celCant").innerHTML = objProducto[1].Env_Cant;
                }
                $('#modalViewProveedor').modal('show');

            }else{
                swal("Error", objData.msg , "error");
            }
        }
    } 
}
function fntEditEnv(element,idProv){
    $('#modalEnvio').modal('show');

    if(document.querySelector("#formEnvio")){
         document.querySelector("#txtIdpro").value=idProv;    
        let formProveedores = document.querySelector("#formEnvio");
        formProveedores.onsubmit = function(e) {
            e.preventDefault();
            let strCantidad = document.querySelector('#txtCantidadx').value;
            let strCate = document.querySelector('#xdCategoria').value;
            if(strCantidad == '' || strCate == '' ||strCate<=0||strCantidad<=0)
            {
                swal("Atención", "Todos los campos son obligatorios y no pueden ser negativos." , "error");
                return false;
            }
            divLoading.style.display = "flex";
            tinyMCE.triggerSave();
            let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Proveedores/setEnvio'; 
            let formData = new FormData(formEnvio);
            formData.append('txtCantidadx',strCantidad);
            formData.append('xdCategoria',strCate);
            formData.append('txtIdpro',document.querySelector("#txtIdpro").value);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("", objData.msg ,"success");
                        $('#modalEnvio').modal("hide");
                        formProveedores.reset();
                        swal("", objData.msg ,"success");
                        tableProveedores.api().ajax.reload();
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
          }
    }

}
function resetear(){
     swal({
        title: "¡Eliminar envios de proveedores!",
        text: "¿Realmente quiere eliminar todos los envios de los proveedores? (Esta acción no se puede deshacer)",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Proveedores/delEnvios   ';
            let strData = "";
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = request;
                    console.log(objData.value);
                    if(objData.status)
                    {
                        swal("¡Eliminar!", "Todo se ha eliminado con éxito" , "success");
                        tableProveedores.api().ajax.reload();
                    }else{
                        swal("¡Atención!", "No fue posible realizar el proceso" , "error");
                    }
                }
            }
        }

    });
}

function fntDelEnvioE(idProveedor){
    swal({
        title: "Eliminar envio",
        text: "¿Realmente quiere eliminar el envio?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Proveedores/delEnvio';
            let strData = "idProveedor="+idProveedor;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableProveedores.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}