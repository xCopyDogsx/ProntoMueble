var fecha = new Date();
var ano = fecha.getFullYear();
var data = {
      	labels: ["Ene.", "Feb", "Marz.", "Abr.", "May.","Jun.","Jul.","Ago.","Sep.","Oct.","Nov.","Dic."],
      	datasets: [
      		{
      			label: "Año "+ano,
      			fillColor: "rgba(220,220,220,0.2)",
      			strokeColor: "rgba(220,220,220,1)",
      			pointColor: "rgba(220,220,220,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(220,220,220,1)",
      			data: [65, 59, 80, 81, 56,65, 59, 80, 81, 56,20,30]
      		},
      		{
      			label: "Año "+(ano-1),
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [28, 48, 40, 19, 86,20,10,150,10,13,100,30]
      		}
      	]
      };
      if(complete==0||pendiente==0){
             swal("Atención", "Puede que algunos graficos no se generen dado a que el valor de sus datos es 0, se colocarán valores de prueba." , "error");
             complete=50;
             pendiente=50;
      }
      var pdata = [
      	{
      		value: complete,
      		color: "#46BFBD",
      		highlight: "#5AD3D1",
      		label: "Completados"
      	},
      	{
      		value: pendiente,
      		color:"#F7464A",
      		highlight: "#FF5A5E",
      		label: "En progreso"
      	}
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
