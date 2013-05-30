var payMvc = (function(){
   var fields = {
       //WMI_MERCHANT_ID: 0,
       WMI_CURRENCY_ID: 643,
       WMI_SUCCESS_URL: '',
       WMI_FAIL_URL: ''
       // WMI_PAYMENT_NO: '',
       // WMI_DESCRIPTION: ''
   }

    var _keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

    function setPreInitData(pName, pValue){
        fields[pName] = pValue;
        // func. setPreInitData
    }

    function setFormInput(pName, pValue){
        if ( jQuery('#payForm input[name="'+pName+'"]:first').val(pValue).length == 0 ){
            var input = document.createElement("input");
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', pName);
            input.setAttribute('value', pValue);
            jQuery('#payForm').append(input);
        }
        // func. setFormInput
    }

    function submit(){
        jQuery.ajax({
            url: '/webcore/func/utils/hashcode/',
            data: jQuery('#payForm').serialize(),
            type: 'post',
            dataType: 'json',
            success: function(pData){
                setFormInput('WMI_SIGNATURE', pData.key);
                jQuery('#payForm').submit();
            }
        })
        // func. submit
    }

    function base64Encode (input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = _utf8_encode(input);

        while (i < input.length) {
            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output +
                _keyStr.charAt(enc1) + _keyStr.charAt(enc2) +
                _keyStr.charAt(enc3) + _keyStr.charAt(enc4);

        }

        return output;
        // func. base64Encode
    }

    function _utf8_encode(string){
        string = string.replace(/\r\n/g,"\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
        // func. _utf8_encode
    }


    function init(pFields){
       jQuery.extend(fields, pFields);
       //console.log(fields);
       var payForm = document.createElement("form");
       payForm.setAttribute('id', 'payForm');
       payForm.setAttribute('method', 'post');
       payForm.setAttribute('action', 'https://merchant.w1.ru/checkout/default.aspx');
       payForm.setAttribute('accept-charset', 'UTF-8');
       payForm.setAttribute('style', 'display: none');

       for( var key in fields ){
           var input = document.createElement("input");
           input.setAttribute('type', 'hidden');
           input.setAttribute('name', key);
           input.setAttribute('value', fields[key]);
           payForm.appendChild(input);
       }

       //document.body.appendChild(payForm);
        jQuery(document.body).append(payForm);
       // func. init
    }
    return{
        init: init,
        setPreInitData: setPreInitData,
        setFormInput: setFormInput,
        base64Encode: base64Encode,
        submit: submit
    }
})();
