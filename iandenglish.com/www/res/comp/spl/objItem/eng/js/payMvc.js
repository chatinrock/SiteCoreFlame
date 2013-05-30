var payMvc = (function(){
   var fields = {
       WMI_MERCHANT_ID: 175436398732,
       WMI_CURRENCY_ID: 643,
       WMI_SUCCESS_URL: '',
       WMI_FAIL_URL: ''
       // WMI_PAYMENT_NO: '',
       // WMI_DESCRIPTION: ''
   }

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
        jQuery('#payForm').submit();
        // func. submit
    }

    function init(){
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
        submit: submit
    }
});