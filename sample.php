
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Convert or Export HTML Table to PDF file using jQuery | Tutorialswebsite</title>
     <style type="text/css">
        body
        {
            font-family: Arial;
            font-size: 10pt;
        }
        table
        {
            border: 1px solid #ccc;
            border-collapse: collapse;
        }
        table th
        {
            background-color: #F7F7F7;
            color: #333;
            font-weight: bold;
        }
        table th, table td
        {
            padding: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
     <table id="tblCustomers" cellspacing="0" cellpadding="0">
        <tr>
            <th>Customer Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
        <tr>
            <td>1</td>
            <td>John </td>
            <td>jhon@gmail.com</td>
            <td>0445607456</td>
            <td>United States</td>
        </tr>
        <tr>
              <td>2</td>
            <td>Rohan </td>
            <td>rohan@gmail.com</td>
            <td>0545607456</td>
            <td>Bangluru</td>
        </tr>
        <tr>
              <td>3</td>
            <td>Pradeep </td>
            <td>pradeep@gmail.com</td>
            <td>0996507456</td>
            <td>Delhi</td>
        </tr>
        <tr>
             <td>4</td>
            <td>Sonia </td>
            <td>sonia@gmail.com</td>
            <td>07899607456</td>
            <td>Varanasi</td>
        </tr>
    </table>
    <br />
    <input type="button" id="btnExport" value="Export" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", "#btnExport", function () {
            html2canvas($('#tblCustomers')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("cutomer-details.pdf");
                }
            });
        });
    </script>
</body>
</html>
 