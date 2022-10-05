$(document).ready(function () {

    listUser()


});

const addUser = () => {

    // validação de campos vazios

    // let nome = $('#nome').val()

    // if(nome == ''){
    //     Swal.fire({
    //         title: 'Atenção',
    //         text: 'Preencha o campo do nome, por favor!',
    //         icon: 'error'
    //     })
    //     return
    // }

    // let nome = document.getElementById('nome').value 
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
                <td class="text-center">${moment(usuario.data_cadastro).format('DD/MM/YYYY HH:mm')}</td>
                <td class="text-center">
                        <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="${usuario.ativo == 1 ? 'flexSwitchCheckChecked' : 'flexSwitchCheckDefault'}" ${usuario.ativo == 1 ? 'checked' : ''} onchange="updateUserActive(${usuario.id})">
                        <label class="form-check-label" for="${usuario.ativo == 1 ? 'flexSwitchCheckChecked' : 'flexSwitchCheckDefault'}">${usuario.ativo == 1 ? 'ativo' : 'desativado'}</label>
                        </div>
                </td>
                <td class="text-center">
                <button class="btn btn-primary" type="submit"><i class="bi bi-pencil-square"></i></button>
                <button class="btn btn-danger" type="submit" onclick="removeUser(${usuario.id})"><i class="bi bi-person-dash"></i></button>
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

const removeUser = (id) => {
    const result = fetch(`backend/removeUser.php`, {
        method: 'POST',
        body: `id=${id}`,
        headers: {
            'Content-type': 'application/x-www-form-urlencoded'
        }
    })

    .then((response) => response.json())
    .then((result) => {

        Swal.fire({
            icon: result.retorno == 'ok' ? 'success' : 'error',
            title: result.Mensagem,
            timer: 2000
        })

        listUser()
    

})

}

const updateUserActive = (id) => {
    const result = fetch(`backend/_update_user_ative.php`, {
        method: "POST",
        body: `id=${id}`,
        headers: {
            'Content-type': 'application/x-www-form-urlencoded'
        }

    })

    .then((response) => response.json())
    .then((result) => {

        Swal.fire({
            icon: result.retorno == 'ok' ? 'success' : 'error',
            title: result.Mensagem,
            timer: 2000
        })

        listUser()
    });

    


}