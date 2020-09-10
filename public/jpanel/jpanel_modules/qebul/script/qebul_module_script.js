// JavaScript Document
 $(document).ready(function () {
            var url = "admin_backend.php?module=qebul&action=load_derman";
            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'name' },
                    { name: 'phone'},
                    { name: 'insertDate',type: 'date' },
                    { name: 'selectedDate',type: 'date' },
					{ name: 'selectedTime' },
					{ name: 'doctor' },
					{ name: 'service' },
                ],
                id: 'LOGICALREF',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                width: 1060,
				pageable: true,
                autoheight: true,
				sortable: true,
                source: dataAdapter,
                columnsresize: true,
				filterable: true,
				pagesize: 20,
                columns: [
                  { text: 'Ad soyad', dataField: 'name', width: 180 },
                  { text: 'Telefon', dataField: 'phone', width: 130,filtertype: 'checkedlist' },
                  { text: 'Doldurulma tarixi', dataField: 'insertDate',filtertype: 'date', width: 150,cellsformat: 'yyyy-MM-dd hh:mm:ss'  },
                  { text: 'Tarix', dataField: 'selectedDate',filtertype: 'date', width: 110 ,cellsformat: 'yyyy-MM-dd' },
				  { text: 'Saat', dataField: 'selectedTime', width: 80 },
				  { text: 'Doktor', dataField: 'doctor', width: 180 ,filtertype: 'checkedlist' },
				  { text: 'Xidmet', dataField: 'service', width: 210 ,filtertype: 'checkedlist' }
                ]
            });
 });