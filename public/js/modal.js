function fillModalInputFields(modal_id, result){
    formReset(modal_id);

    let inputs = $(`${modal_id} .modal-body :input`);

    inputs.each(function(field){
        if(this.name in result){
            let value = result[this.name];
            if($(this).is('select') && value){
                $(this).val(value['id']);
                if ($(this).val()==null){
                    selectOption(this, value);
                }
            } else if($(this).is(':checkbox')){
                $(this).prop("checked", value)
            } else {
                $(this).val(value);
            }
        }
    })
}

function formReset(modal_id){
    $(`${modal_id} input:hidden[name='id']`).val('');
    $(`${modal_id} form`).trigger("reset");
}

function selectOption(select, value) {
    let dd = document.getElementsByName(select.name)[0];
    for (let i = 0; i < dd.options.length; i++) {
        if (dd.options[i].text === value) {
            dd.selectedIndex = i;
            break;
        }
    }
}

function openModal(elem) {
    let modal = $(modalID);
    modal.find('form')[0].reset();
    let row = elem.parentElement.parentElement.children;
    let row_info = {
        id: row[0].innerText,
        status: row[3].innerText,
    };
    fillModalInputFields(modalID, row_info);
    modal.modal("show");

    //
    // $('#left-to-allocate').val(row_info["total_refund"]);
    // modal.modal('show');

}
