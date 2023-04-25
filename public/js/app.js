$(document).ready(function(){
	let notyf = new Notyf();
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	/** Form */
    $('#formModalPost').on('submit', function (e) {
        e.preventDefault();
        var form, action, method, data;
        form = $('#formModalPost');
        action = form.attr('action')
        method = form.attr('method')
        data = form.serialize();

        $('.form-control').removeClass('is-invalid')
        $('.invalid-feedback').html('')

        $.ajax({
            type: method,
            url: action,
            data: data,
            beforeSend: function () {
                $('body').loadingModal();
            },
            success: function (res) {
                $('body').loadingModal('destroy');
                $('#dataTable').DataTable().ajax.reload(null, false);
                if (!res.error) {
                    formReset()
                    $('#modalPost').modal('hide')
                    notyf.success(res.message)
                } else {
                    Swal.fire({
						icon: 'error',
						html: res.message
					})
                }
            },
            error: function (xhr) {
                $('body').loadingModal('destroy');
                var res = xhr.responseJSON;
                if(!res.status) {
                    notyf.error(res.message)
                }
                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors, function (key, value) {
                        $('#' + key).addClass('is-invalid')
                        $('#feedback_' + key).html(value[0])
                    });
                }
            }
        });
    })

	$('#formModalImport').on('submit', function (e) {
        e.preventDefault();
        var form, action, method, data;
        form = $('#formModalImport');
        action = form.attr('action')
        method = form.attr('method')
        data = new FormData(form[0]);
    
        $('.form-control').removeClass('is-invalid')
        $('.invalid-feedback').html('')
    
        $.ajax({
            type: method,
            url: action,
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('body').loadingModal();
            },
            success: function (res) {
                $('body').loadingModal('destroy');
                $('#dataTable').DataTable().ajax.reload(null, false);
                if (res.status) {
                    formReset()
                    $('#modalImport').modal('hide')
                    notyf.success(res.message)
                } else {
                    notyf.error(res.message)
                }
            },
            error: function (xhr) {
                $('body').loadingModal('destroy');
                var res = xhr.responseJSON;
                if(!res.status) {
                    notyf.error(res.message)
                }
                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors, function (key, value) {
                        $('#' + key).addClass('is-invalid')
                        $('#feedback_' + key).html(value[0])
                    });
                }
            }
        });
    })

    $('#formModalDownload').on('submit', function (e) {
        e.preventDefault();
        var form, action, method, data;
        form = $('#formModalDownload');
        action = form.attr('action')
        method = form.attr('method')
        data = form.serialize();

        $('.form-control').removeClass('is-invalid')
        $('.invalid-feedback').html('')

        $.ajax({
            type: method,
            url: action,
            data: data,
            beforeSend: function () {
                $('body').loadingModal();
            },
            success: function (res) {
                $('body').loadingModal('destroy');
                $('#dataTable').DataTable().ajax.reload(null, false);
                if (!res.error) {
                    formReset()
                    $('#modalDownload').modal('hide')
                    notyf.success(res.message)
                } else {
                    Swal.fire({
						icon: 'error',
						html: res.message
					})
                }
            },
            error: function (xhr) {
                $('body').loadingModal('destroy');
                var res = xhr.responseJSON;
                if(!res.status) {
                    notyf.error(res.message)
                }
                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors, function (key, value) {
                        $('#' + key).addClass('is-invalid')
                        $('#feedback_' + key).html(value[0])
                    });
                }
            }
        });
    })

    $('#modalPost').on('hidden.bs.modal', function (e) {
        formReset();
    });

    $('#modalImport').on('hidden.bs.modal', function (e) {
        formReset();
    });

    $('#modalDownload').on('hidden.bs.modal', function (e) {
        formReset();
    });

    function formReset(){
        $('#formModalPost').trigger('reset')
        $('#formModalImport').trigger('reset')
        $('#formModalDownload').trigger('reset')
        $('.select2').val(null).trigger('change')
        $('.select2-allowClear').val(null).trigger('change')
        $('.select2-infinity').val(null).trigger('change')
        $('.select2-infinity-allowClear').val(null).trigger('change')
    }
    
	/** Button */
	$('.btn-download').on('click', function (event) {
		event.preventDefault();
		$.ajax({
			url: $(this).attr('href'),
			type: 'GET',
			beforeSend: function () {
				$('body').loadingModal({
					backgroundColor: 'rgb(62, 142, 247)',
					animation: 'cubeGrid'
				});
			},
			success: function (res) {
				$('body').loadingModal('destroy')
				$('#dataTable').DataTable().ajax.reload(null, false);
				if(!res.error){
					Swal.fire({
						icon: 'success',
						html: res.message
					})
				}else{
					Swal.fire({
						icon: 'error',
						html: res.message
					})
				}
			}
		})
	});
    
    $('.btn-generate').on('click', function (event) {
        event.preventDefault();
        Swal.fire({
            icon: 'warning',
            html: 'Proses ini akan membutuhkan waktu yang cukup lama!',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak!',
            backdrop: false,
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: $(this).attr('href'),
                    type: 'POST',
                    beforeSend: function () {
                        $('body').loadingModal({
                            backgroundColor: 'rgb(62, 142, 247)',
                            animation: 'cubeGrid'
                        });
                    },
                    success: function (res) {
                        $('body').loadingModal('destroy')
                        $('#dataTable').DataTable().ajax.reload(null, false);
                        if(res.status){
                            notyf.success(res.message)
                        }else{
                            notyf.error(res.message)
                        }
                    }
                })
            }
        })
    });
});