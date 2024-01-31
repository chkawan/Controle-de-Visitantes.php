
// //DATABASE
 $(document).ready(function() {
    $('#listar-visitantes').DataTable({
        "order": 
                [   [ 2, 'desc' ]
                ],
        "columnDefs": [
            {
                "targets": [4, 5, 6, 7, 9,10, 12,],
                "visible": false,
            }
        ],
       'dom': "<'row'<'col-sm-12 col-md-5 m-1'l>>" + 
       "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    'buttons': [{
                            'extend': 'colvis',
                            'text': 'Visibilidade de Colunas',
                        },
                        {
                            'extend': 'excel',
                            'text': 'Exportar para Excel',
                            'exportOptions': {
                                'columns': ':visible'
                            }
                        },
                        {
                            'extend': 'pdf',
                            'text': 'Exportar para PDF',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'exportOptions': {
                                'columns': ':visible'
                            }
                        }
                    ],
        "ajax": "processa_lista_visitantes.php",
        "oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ registros por página",
            "sZeroRecords": "Nenhum registro encontrado",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registro(s)",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros)",
            "sSearch": "Pesquisar: ",
            "oPaginate": {
                "sFirst": "Início",
                "sPrevious": "Anterior",
                "sNext": "Próximo",
                "sLast": "Último"
            }
        } 
    });
});


//-----------------------------------------------------------------------------------//

//DATABASE
$(document).ready(function() {
    $('#listar-visitas').DataTable({
        "order": 
                [   [ 1, 'desc' ], 
                    [ 2, 'asc' ]
                ],
         "columnDefs": [
            {
                "targets": [0, 5, 6, 7, 9, 10, 12, 13, 14, 15, ,17],
                "visible": false,   
            },
        ],
       'dom': "<'row'<'col-sm-12 col-md-5 m-1'l>>" + 
       "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    'buttons': [{
                            'extend': 'colvis',
                            'text': 'Visibilidade de Colunas',
                        },
                        {
                            'extend': 'excel',
                            'text': 'Exportar para Excel',
                            'exportOptions': {
                                'columns': ':visible'
                            }
                        },
                        {
                            'extend': 'pdf',
                            'text': 'Exportar para PDF',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'exportOptions': {
                                'columns': ':visible'
                            }
                        }
                    ],
        "ajax": "processa_lista_visitas.php",
        "oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ registros por página",
            "sZeroRecords": "Nenhum registro encontrado",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registro(s)",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros)",
            "sSearch": "Pesquisar: ",
            "oPaginate": {
                "sFirst": "Início",
                "sPrevious": "Anterior",
                "sNext": "Próximo",
                "sLast": "Último"
            }
        }, 
    });
});

//-----------------------------------------------------------------------------------//
//SUB CATEGORIA - CAD_VISITANTES
let Selectmarca = document.getElementById('marca');

marca.onchange = () => {
    let modelo = document.getElementById('modelo');

    let valor = marca.value;

    fetch("selectcategorias.php?marca=" + valor)
    .then( response => {
        return response.text();
    })
    .then(texto =>{
        modelo.innerHTML = texto;
    });
     console.log(Selectmarca);
        var placa = document.getElementById('placa');
        var ano = document.getElementById('ano_car');
        var cor = document.getElementById('cor_car');
    if((valor == "Nenhum")  && 
    (placa.value == "")  &&
    (ano.value == "")  &&
    (cor.value == "") ){
            placa.value = "000-000";
            ano.value = "0000";
            cor.value = "Nenhuma";
    };
    if((valor == "Nenhum") && (placa.value == "")){
        placa.value = "000-000";
    };
    if((valor == "Nenhum") && (ano.value == "")){
        ano.value = "0000";
    };
    if((valor == "Nenhum") && (cor.value == "")){
        cor.value = "Nenhuma";
    };
};

// APAGAR VISITANTE

// async function apagarUsuario(id) {
//     //console.log("Acessou: " + id);

//     var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

//     if (confirmar) {
//         const dados = await fetch("apagar.php?id=" + id);
//         const resposta = await dados.json();
//         //console.log(resposta);

//         if (resposta['status']) {
//             document.getElementById("msgAlerta").innerHTML = resposta['msg'];

//             // Atualizar a lista de registros
//             listarDataTables = $('#listar-visitantes').DataTable();
//             listarDataTables.draw();

//         } else {
//             document.getElementById("msgAlerta").innerHTML = resposta['msg'];
//         }
//     }
// };
