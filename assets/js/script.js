$(document).ready(function () {

    listUser()


});

const addUser = () => {

    let dados = new FormData($('#form-usuarios')[0])

    const result = fetch('backend/addUser.php', {
        method: 'POST',
        body: dados
    })
        .then((response) => response.json())
        .then((result) => {

            Swal.fire({
                title: 'Atenção',
                text: result.Mensagem,
                icon: result.retorno == 'ok' ? 'success' : 'error'
            })

            result.retorno == 'ok' ? $('#form-usuarios')[0].reset() : ''

            result.retorno == 'ok' ? listUser() : ''
        })

}

const listUser = () => {
    const result = fetch('backend/listUser.php', {
        method: 'POST',
        body: ''
    })
        .then((response) => response.json())
        .then((result) => {

            let datahora = moment().format('DD/MM/YY HH:mm')
            $('#horario-atualizado').html(datahora)

                $("#tabela").dataTable().fnDestroy();
                $("#tabela-dados").html('')

            result.map(usuario => {
                $('#tabela-dados').append(`
            <tr>
                <td>${usuario.nome}</td>
                <td>${usuario.email}</td>
                <td class="text-center">
                <button class="btn btn-primary" type="submit"><i class="bi bi-pencil-square"></i></button>
                <button class="btn btn-danger" type="submit" onclick="removeUser()"><i class="bi bi-person-dash"></i></button>
                </td>
            </tr>
        `)
            })
            $('#tabela').DataTable({
                "language": { 
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json',
                    retrive: true,
                }
                
            });
        })
    }

const removeUser = () => {
    const result = fetch(`backend/removeUser.php?id=${usuario.id}`, {
        method: 'GET',
        body: ''
    })

    Swal.fire({
        title: 'deleted user',
        text: result.Mensagem,
        icon: result.retorno == 'ok' ? 'success' : 'error'
    })

}

