
var tableRoles;

document.addEventListener('DOMContentLoaded', function(){

	tableRoles = $('#tableRoles').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Roles/getRoles",
            "dataSrc":""
        },
        "columns":[
            {"data":"Rol_ID"},
            {"data":"Rol_Nom"},
            {"data":"Rol_Desc"},
            {"data":"Rol_Status"},
            {"data":"options"}
        ],
        "responsive":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });

    //NUEVO ROL
    var formRol = document.querySelector("#formRol");
    formRol.onsubmit = function(e) {
        e.preventDefault();

        var intIdRol = document.querySelector('#idRol').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strDescripcion = document.querySelector('#txtDescripcion').value;
        var intStatus = document.querySelector('#listStatus').value;        
        if(strNombre == '' || strDescripcion == '' || intStatus == '')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Roles/setRol'; 
        var formData = new FormData(formRol);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
           if(request.readyState == 4 && request.status == 200){
                
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#modalFormRol').modal("hide");
                    formRol.reset();
                    swal("Roles de usuario", objData.msg ,"success");
                    tableRoles.api().ajax.reload(function(){ 
                        fntEditRol();
                        fntDelRol();
                        fntPermisos();
                    });
                }else{
                    swal("Error", objData.msg , "error");
                }              
            } 
        }

        
    }

});

$('#tableRoles').DataTable();

function openModal(){

    //document.querySelector('#idRol').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
    document.querySelector("#formRol").reset();
	$('#modalFormRol').modal('show');
}

window.addEventListener('load', function() {
    fntEditRol();
    fntDelRol();
    //fntPermisos();
}, false);

function fntEditRol(){
    var btnEditRol = document.querySelectorAll(".btnEditRol");
    btnEditRol.forEach(function(btnEditRol) {
        btnEditRol.addEventListener('click', function(){

            document.querySelector('#titleModal').innerHTML ="Actualizar Rol";
            document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
            document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btnText').innerHTML ="Actualizar";

            var idrol = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl  = base_url+'/Roles/getRol/'+idrol;
            request.open("GET",ajaxUrl ,true);
            request.send();

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    
                    var objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        document.querySelector("#idRol").value = objData.data.Rol_ID;
                        document.querySelector("#txtNombre").value = objData.data.Rol_Nom;
                        document.querySelector("#txtDescripcion").value = objData.data.Rol_Desc;

                       if(objData.data.status == 1)
                        {
                            var optionSelect = '';
                        }else{
                            var optionSelect = '';
                        }
                        var htmlSelect = `${optionSelect}
                                          <option value="1">Activo</option>
                                          <option value="2">Inactivo</option>
                                        `;
                        document.querySelector("#listStatus").innerHTML = htmlSelect;
                        $('#modalFormRol').modal('show');
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
            }
            
        });
    });
}

function fntDelRol(){
    var btnDelRol = document.querySelectorAll(".btnDelRol");
    btnDelRol.forEach(function(btnDelRol) {
        btnDelRol.addEventListener('click', function(){
            var idrol = this.getAttribute("rl");
            swal({
                title: "Eliminar Rol",
                text: "¿Realmente quiere eliminar el Rol?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, eliminar",
                cancelButtonText: "No, cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                
                if (isConfirm) 
                {
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = base_url+'/Roles/delRol/';
                    var strData = "Rol_ID="+idrol;
                    request.open("POST",ajaxUrl,true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send(strData);
                    request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status == 200){
                            var objData = JSON.parse(request.responseText);
                            if(objData.status)
                            {
                                swal("Eliminar!", objData.msg , "success");
                                tableRoles.api().ajax.reload(function(){
                                    fntEditRol();
                                    fntDelRol();
                                    fntPermisos();
                                });
                            }else{
                                swal("Atención!", objData.msg , "error");
                            }
                        }
                    }
                }else{
                    swal("Acción cancelada", "" , "error");
                }

            });

        });
    });
}

function fntPermisos(){
    var btnPermisosRol = document.querySelectorAll(".btnPermisosRol");
    btnPermisosRol.forEach(function(btnPermisosRol) {
        btnPermisosRol.addEventListener('click', function(){

            var idrol = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Permisos/getPermisosRol/'+idrol;
            request.open("GET",ajaxUrl,true);
            request.send();

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    document.querySelector('#contentAjax').innerHTML = request.responseText;
                    $('.modalPermisos').modal('show');
                    document.querySelector('#formPermisos').addEventListener('submit',fntSavePermisos,false);
                }
            }
            
            
        });
    });
}

function fntSavePermisos(evnet){
    evnet.preventDefault();
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Permisos/setPermisos'; 
    var formElement = document.querySelector("#formPermisos");
    var formData = new FormData(formElement);
    request.open("POST",ajaxUrl,true);
    request.send(formData);

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                swal("Permisos de usuario", objData.msg ,"success");
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
    
}