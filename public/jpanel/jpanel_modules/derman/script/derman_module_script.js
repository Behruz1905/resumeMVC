// JavaScript Document
 $(document).ready(function () {
            var url = "admin_backend.php?module=derman&action=load_derman";
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'LOGICALREF' },
                    { name: 'MAL_ADI' },
                    { name: 'MAL_VAHIDI'},
                    { name: 'MAL_OLKE' },
                    { name: 'MAL_TERKIB' },
                ],
                id: 'LOGICALREF',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                width: 850,
				pageable: true,
                autoheight: true,
				sortable: true,
                source: dataAdapter,
                columnsresize: true,
				filterable: true,
				pagesize: 20,
                columns: [
                  { text: 'LOGICALREF', dataField: 'LOGICALREF', width: 100 },
                  { text: 'MAL_ADI', dataField: 'MAL_ADI', width: 270 },
                  { text: 'MAL_VAHIDI', dataField: 'MAL_VAHIDI', width: 100,filtertype: 'checkedlist' },
                  { text: 'MAL_OLKE', dataField: 'MAL_OLKE', width: 80,filtertype: 'checkedlist'  },
                  { text: 'MAL_TERKIB', dataField: 'MAL_TERKIB', width: 290 }
                ]
            });
 });