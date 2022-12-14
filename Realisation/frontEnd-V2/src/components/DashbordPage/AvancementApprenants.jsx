import React from "react";
import axios from "axios";
import Cookies from "universal-cookie";
import QuickChart from "quickchart-js";
import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";

function AvancementApprenant(){
    
    const ParamsId = useParams();
    const [ApprenantAV, setApprenantAV] = useState([]);
    const [AllBriefs, setAllBriefs] = useState([]);
    const [IdGroupe, setIdGroupe] = useState([]);
    const [Apprenants, setApprenants] = useState([]);
    const [paramsId, setparamsId] = useState();
   const cookies = new Cookies();

   useEffect(() => {
       
       const AvancementApprenant = async () => {
        //    setparamsId(ParamsId.id)
              console.log(ParamsId)
            let idFormateur = cookies.get("FormateurID");
            await axios
              .get("http://localhost:8000/api/OneGroupe/" + idFormateur)
              .then((res) => {
                setApprenants(res.data[2]);
                setAllBriefs(res.data[4]);
                setApprenantAV(res.data[5]);
                setIdGroupe( res.data[0].idGroupe);
              });
          };
          AvancementApprenant()
          


    }, []);

  
    

    const selectBrief=(e)=>{
        const briefId = e.target.value;
        axios
          .get(
            "http://localhost:8000/api/Av_ApprenantTache/" +
              IdGroupe +
              "/" +
              briefId
          )
          .then((res) => {
            setApprenantAV(res.data[0]);
            // console.log(res.data[0])
          });

        console.log(e.target.value)
    }


    const ChartApprenant = new QuickChart();

    ChartApprenant.setConfig({
      type: "progressBar",
      data: {
        datasets: [
          {
            data: ApprenantAV.map((value) => value.Percentage),
            backgroundColor: "blue",
          },
        ],
      },
  
      options: {
        plugins: {
          datalabels: {
            formatter: (val) => {
              return val.toLocaleString() + "%";
            },
  
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
  
    const ApprenantImage = ChartApprenant.getUrl();
  

    return(
        <div className="col-6 border border-dark">
        <h2>Etat d'avencement des apprenants : </h2>
        <div className="col-sm">
          <select onChange={selectBrief} name="" id="">
            {AllBriefs.map((value) => (
              <option key={value.id} value={value.id}>
                {value.Nom_du_brief}
              </option>
            ))}
          </select>
        </div>
        {Apprenants.map((value) => (
          <div key={value.id}>
            <li key={value.id}>
              {value.Nom} {value.Prenom}
            </li>
          </div>
        ))} 
        <img style={{ width: 300 }} src={ApprenantImage}></img> 

        <h1>{paramsId} </h1>
      </div>
    )
}
export default AvancementApprenant