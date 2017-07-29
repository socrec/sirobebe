$(function () {
    $('#customer-load').select2({
        ajax: {
            dataType: 'json',
            url: "/customer/load",
            minimumInputLength: 1,
            data: function (params) {
                return {
                    term: params.term
                }
            },
            processResults: function (data, page) {
                return {
                    results: data
                };
            },
        }
    });
})