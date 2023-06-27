$(function () {

    let edit = null;

    $('#search').keyup(function (e) {

        let search =  '';
        if ($('#search').val()) {
            search = $('#search').val()
            $.ajax({
                url: 'backend/cliente.search.php',
                type: 'POST',
                data: { search },
                success: function (response) {
                    let data = JSON.parse(response);
                    // console.log(data);

                    let template = '';
                    data.forEach(element => {
                    template += `
                    <tr>
                        <th scope="row">${element.id}</th>
                        <td>${element.nombre} ${element.apellido_paterno} ${element.apellido_materno}</td>
                        <td>${element.domicilio}</td>
                        <td>${element.correo}</td>
                        <td></td>
                    </tr>
                    `;
                });

                $('#lista').html(template);
                }
            })
        } else {
            list();
        }
        // console.log(search);
    });

    $('#cliente-form').submit(function (e) {
        const postData = {
            id: edit,
            nombre: $('#nombre').val(),
            apellido_paterno: $('#paterno').val(),
            apellido_materno: $('#materno').val(),
            domicilio: $('#direccion').val(),
            correo: $('#correo').val(),
        }

        console.log(edit);

        let url = edit ? 'backend/cliente.update.php' : 'backend/cliente.create.php';

        console.log(url);

        $.post(url, postData, function (response) {
                list();
                $('#cliente-form').trigger('reset');
                edit = null;
        });
        
        e.preventDefault();
    });

    function list() {
        $.ajax({
            url: 'backend/cliente.list.php',
            type: 'POST',
            success: function (response) {
                let data = JSON.parse(response);
                // console.log(data);
                let template = '';
                data.forEach(element => {
                    template += `
                    <tr clienteId="${element.id}">
                        <th scope="row">${element.id}</th>
                        <td>${element.nombre} ${element.apellido_paterno} ${element.apellido_materno}</td>
                        <td>${element.domicilio}</td>
                        <td>${element.correo}</td>
                        <td>
                            <button class="class-edit btn btn-warning btn-sm">
                                Editar
                            </button>
                        </td>
                        <td>
                            <button class="class-delete btn btn-danger btn-sm">
                                Borrar
                            </button>
                        </td>
                    </tr>
                    `;
                });

                $('#lista').html(template);
            }
        })
    };

    $(document).on('click','.class-delete', function(e) {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('clienteId');
        // console.log(id);

        $.post('backend/cliente.delete.php', {id}, function (response) {
            console.log(response);
            list();
            // $('#cliente-form').trigger('reset');
        });
    });

    $(document).on('click','.class-edit', function(e) {
        let element = $(this)[0].parentElement.parentElement;
        edit = $(element).attr('clienteId');
        
        $.post('backend/cliente.read.php', { id: edit }, function (response) {
            let data = JSON.parse(response);
            console.log(data);

            $('#nombre').val(data.nombre);
            $('#paterno').val(data.apellido_paterno);
            $('#materno').val(data.apellido_materno);
            $('#direccion').val(data.domicilio);
            $('#correo').val(data.correo);
        });
    });

    list();

});