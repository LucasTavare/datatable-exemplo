$(document).ready(function () {

    $('#tabela').DataTable({
        "language": {url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'}
    });
});

const addUser = () =>{

    let dados = new FormData($('#form-usuarios')[0])

    const result = fetch('backend/addUser.php',{
        method: 'POST',
        body: dados
    })
    .then((response)=>response.json())
    .then((result)=>{

        Swal.fire({
           title: 'Atenção',
           text: result.Mensagem,
           icon: result.retorno == 'ok' ? 'success' : 'error'
          })

            result.retorno == 'ok'? $('#form-usuarios')[0].reset() : ''
          
    })

}



