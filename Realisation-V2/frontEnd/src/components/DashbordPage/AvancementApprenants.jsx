import React from "react";
import axios from "axios";
import Cookies from "universal-cookie";
import QuickChart from "quickchart-js";
import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { useCallback } from "react";

function AvancementApprenant(props){
    
    const ParamsId = useParams();
    const [ApprenantAV, setApprenantAV] = useState([]);
    const [AllBriefs, setAllBriefs] = useState([]);
    const [IdGroupe, setIdGroupe] = useState([]);
    const [Apprenants, setApprenants] = useState([]);
   const cookies = new Cookies();

   useEffect(() => {
       
       const AvancementApprenant = async () => {
            let idFormateur = cookies.get("FormateurID");
            await axios
              .get("http://localhost:8000/api/Groupe/" + idFormateur)
              .then((res) => {
                // console.log(res.data)
                setApprenants(res.data.ListApprenants);
                setAllBriefs(res.data.ListBrifes);
                setApprenantAV(res.data.FirstBrief);
                setIdGroupe(res.data.Groupe.idGroupe);
              });
          };
          AvancementApprenant()
          


    }, []);



  
   
// selectionner brief
const selectBrief=(e)=>{
    const briefId = e.target.value;
    axios
    .get(
        "http://localhost:8000/api/Av_ApprenantTache/" +  IdGroupe + "/" + briefId
        )
        .then((res) => {
                        // console.log(res.data)

            setApprenantAV(res.data.avancemantBrief);
            setApprenants(res.data.avancemantBrief);
        });
        
        // console.log(e.target.value)
    }

    if (props.ChangeId) {

      const AvancementGroups = async () => {
          await axios.get("http://localhost:8000/api/AvancementApprenant/" + props.ChangeId)
            .then((res) => {
              console.log(res.data)
              setApprenantAV(res.data.avancemantBrief);
              setApprenants(res.data.avancemantBrief);
              setAllBriefs(res.data.ListBrief);
              // cookies.set("GroupeID", res.data.Groupe.idGroupe);
            });
    
          };
          
          
          AvancementGroups()   
        }
      


    
    // Chart Apprenant
    const ChartApprenant = new QuickChart();

    ChartApprenant.setConfig({
      type: "progressBar",
      data: {
        datasets: [
          {
            data: ApprenantAV.map((value) => value.Percentage ),
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
  
// Output
    return(
        <div className="col-6 border border-dark">
        <h2>Etat d'avencement des apprenants : </h2>
        <div className="col-sm">
            {/* selectionner brief */}
          <select onChange={selectBrief} name="" id="">
            {AllBriefs.map((value) => (
              <option key={value.id} value={value.id}>
                {value.Nom_du_brief}
              </option>
            ))}
          </select>
        </div>
        {/* list apprenant */}
        {Apprenants.map((value) => (
            <div key={value.id}>
            <li key={value.id}>
              {value.Nom} {value.Prenom}
            </li>
          </div>
        ))} 
        {/* chart */}
        <img style={{ width: 300 }} src={ApprenantImage}></img> 
      </div>
    )
}
export default AvancementApprenant