import axios from "axios";
import QuickChart from "quickchart-js";

import React from "react";
import { useEffect,useState   } from "react";
import Cookies from "universal-cookie";


function AvancementGroupe(props){
    
    const [Pourcentage, setPourcentage] = useState([]);
    const cookies = new Cookies();
    
    useEffect(() => {
    let idFormateur = cookies.get("FormateurID");

    const avancement = async () => {
        await axios.get("http://localhost:8000/api/Groupe/" + idFormateur)
          .then((res) => {
            
            setPourcentage(res.data.AvancementGroupe[0].Percentage)
            cookies.set("GroupeID", res.data.Groupe.idGroupe);
          });

        };
        avancement()   
   
      }, []);


      if (props.ChangeId) {

      const AvancementGroups = async () => {
          await axios.get("http://localhost:8000/api/AvancementGroups/" + props.ChangeId)
            .then((res) => {
              // console.log(res.data)
              setPourcentage(res.data.Percentage)
              // cookies.set("GroupeID", res.data.Groupe.idGroupe);
            });
    
          };
          
          
          AvancementGroups()   
        }
      
     
  
      
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
    // console.log(props.data)
    const chartImagee = myChart.getUrl();

    return(

        <div className="col-6 border border-dark ">
        <h2>Etat d' avancement du groupe:</h2>
        <img style={{ width: 300 }} src={chartImagee}></img>
      </div>
    )
}

export default AvancementGroupe