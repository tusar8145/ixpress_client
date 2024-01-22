<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


   <link rel="stylesheet" href="https://cdnjs-de.loli.net/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css'>
  <link rel="shortcut icon" href="fabicon.png" />
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link rel='stylesheet' href='https://cdnjs-de.loli.net/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>

</head>
<body>

<div class="container">
  <h2>Basic Table</h2>
  <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>            
  <table id='table1' class="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
	  </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>
    </tbody>
  </table>
</div>

</body>

	<!--Data Table-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
	 
	 <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js'></script>
    <script src='https://cdnjs-de.loli.net/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
	<script src='https://cdnjs-de.loli.net/ajax/libs/pdfmake/0.1.36/pdfmake.min.js'></script>
	<script src='https://cdnjs-de.loli.net/ajax/libs/pdfmake/0.1.36/vfs_fonts.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js'></script>
 
	<!--Tiny-->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.5/tinymce.min.js'></script>


<script>
	
$(document).ready(function() {
 
  var table_title='jh';
  var export_title='hgj';
    <?php if($export_columns==''){
		$export_columns='\':visible\'';
		}?>
 
  var table =$("#table1").DataTable({
    aaSorting: [],
    responsive: true,

    columnDefs: [
      {
        responsivePriority: 1,
        targets: 0
      },
      {
        responsivePriority: 2,
        targets: -1
      }
    ],
	
 dom: 'Bfrt<"col-md-6 inline"i> <"col-md-6 inline"p>',	
	buttons: {
          dom: {
            container:{
              tag:'div',
              className:'flexcontent'
            },
            buttonLiner: {
              tag: null
            }
          },
          
          
          
          
          buttons: [


                    {
                        extend:    'copyHtml5',
                        text:      '<i class="fa fa-clipboard"> </i> Copy',
                        title:export_title,
                        titleAttr: 'Copiar',
                        className: 'btn btn-app export barras',
                        exportOptions: {
                              columns: <?php echo $export_columns;?>
                        }
                    },

                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="fas fa-file-pdf"> </i> PDF',
                        title:export_title,
                        titleAttr: 'PDF',
                        className: 'btn btn-app export pdf',
                        exportOptions: {
                            columns: <?php echo $export_columns;?>
                        },
                        customize:function(doc) {

                            doc.styles.title = {
                                color: '#4c8aa0',
                                fontSize: '30',
                                alignment: 'center'
                            }
                            doc.styles['td:nth-child(2)'] = { 
                                width: '100px',
                                'max-width': '100px'
                            },
                            doc.styles.tableHeader = {
                                fillColor:'#4c8aa0',
                                color:'white',
                                alignment:'center'
                            },
                            doc.content[1].margin = [ 100, 0, 100, 0 ]

                        }

                    },

                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fas fa-file-excel"> </i> Excel',
                        title:export_title,
                        titleAttr: 'Excel',
                        className: 'btn btn-app export excel',
                        exportOptions: {
                            columns: <?php echo $export_columns;?>
                        },
                    },
                    {
                        extend:    'csvHtml5',
                        text:      '<i class="fas fa-file-csv"> </i> CSV',
                        title:export_title,
                        titleAttr: 'CSV',
                        className: 'btn btn-app export csv',
                        exportOptions: {
                            columns: <?php echo $export_columns;?>
                        }
                    },
                    {
                        extend:    'print',
                        text:      '<i class="fa fa-print"> </i> print',
                        title:export_title,
                        titleAttr: 'Imprimir',
                        className: 'btn btn-app export imprimir',
                        exportOptions: {
                             columns: <?php echo $export_columns;?>
                        }
                    },
                    {
                        extend:    'pageLength',
                        titleAttr: 'Registros a mostrar',
                        className: 'selectTable'
                    }
					]
          
          
        }	
	

  });

 $('#myInput').on( 'keyup', function () {
  table.search( this.value ).draw();
} );
 
  $('[data-toggle="tooltip"]').tooltip();
  });
</script>


</html>
