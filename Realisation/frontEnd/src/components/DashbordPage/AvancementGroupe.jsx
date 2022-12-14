import axios from "axios";
import QuickChart from "quickchart-js";

import React from "react";
import { useEffect,useState   } from "react";
import Cookies from "universal-cookie";


function AvancementGroupe (){
    
    const [Pourcentage, setPourcentage] = useState([]);
    const cookies = new Cookies();
    
    useEffect(() => {
    let idFormateur = cookies.get("FormateurID");

    const avancement = async () => {
        await axios.get("http://localhost:8000/api/OneGroupe/" + idFormateur)
          .then((res) => {
            
            setPourcentage(res.data[3][0].Percentage)
            cookies.set("GroupeID", res.data[0].idGroupe);
          });

        };
        avancement()   
   
}, []);


    const myChart = new QuickChart();

    myChart.setConfig({
      type: "progressBar",
      data: {
        datasets: [
          {
            data: [Pourcentage],
          },
        ],
      },
      options: {
        plugins: {
          datalabels: {
            font: {
              size: 30,
            },
            color: (context) =>
              context.dataset.data[context.dataIndex] > 15 ? "#fff" : "#000",
            anchor: (context) =>
              context.dataset.data[context.dataIndex] > 15 ? "center" : "end",
            align: (context) =>
              context.dataset.data[context.dataIndex] > 15 ? "center" : "right",
          },
        },
      },
    });
  
    const chartImagee = myChart.getUrl();

    return(

        <div className="col-6 border border-dark ">
        <h2>Etat d' avancement du groupe:</h2>
        <img style={{ width: 300 }} src={chartImagee}></img>
      </div>
    )
}

export default AvancementGroupe