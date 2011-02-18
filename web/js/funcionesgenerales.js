function mostrar_mensaje_rapido(titulo, contenido){
    Ext.example.msg(titulo, contenido);
}

function mostrar_mensaje_confirmacion(titulo, contenido){
    Ext.Msg.show({
        title: titulo,
        msg: contenido,
        buttons: Ext.Msg.OK,
        icon: Ext.MessageBox.WARNING
    });
}

function subir_datos(panel, url_Action, extra_params, funcion_success, funcion_failure){
    panel.getForm().submit({
        method:'POST',
		timeout:60000,
        url:url_Action,
        params:extra_params,
        waitTitle:'Enviando',
        waitMsg:'Enviando datos...',
        success:function(response, action){
            obj = Ext.util.JSON.decode(action.response.responseText);
            salida = true;
			if(obj.success==false){
				mostrar_mensaje_confirmacion('Error', obj.errors.reason);
			}
            if (funcion_success != null) {
                funcion_success();
            }
			if(obj.success==true){
				mostrar_mensaje_rapido('Aviso', obj.mensaje);
			}
            
        },
        failure: function(form, action, response){
            if (action.failureType == 'server') {
                obj = Ext.util.JSON.decode(action.response.responseText);
                mostrar_mensaje_confirmacion('Error', obj.errors.reason);
            }
            if (funcion_failure != null) {
                funcion_failure();
            }
            else{
				mostrar_mensaje_rapido('Error', obj.errors.reason);
			}
        }
    });
}
