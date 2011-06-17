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

function getAbsoluteUrl(module, action){
    return urlPrefix + module + '/' + action;
}

function get_absolute_url(module, action){
    return urlPrefix + module + '/' + action;
}

function get_absolute_url_app(app, module, action){
    return urlPrefix + '../' + app + '.php/' +  module + '/' + action;
}

function subir_datos(panel, url_action, extra_params, funcion_success, funcion_failure){
    panel.getForm().submit({
        method:'POST',
		timeout:60000,
        url:url_action,
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

function subirDatosAjax(url_action, extra_params, funcion_success, funcion_failure){

    Ext.Ajax.request({
        method: 'POST',
        url: url_action,
        params: extra_params,
        waitTitle: 'Enviando',
        waitMsg: 'Enviando datos...',
        success: function(response){
            obj = Ext.util.JSON.decode(response.responseText);
            salida = true;
            funcion_success();
            mostrar_mensaje_rapido('Aviso', obj.mensaje);
        },
        failure: function(form, response){
            if (action.failureType == 'server') {
                obj = Ext.util.JSON.decode(response.responseText);
                mostrar_mensaje_confirmacion('Error', obj.errors.reason);
            }
            funcion_failure();
        }
    });
    
}
