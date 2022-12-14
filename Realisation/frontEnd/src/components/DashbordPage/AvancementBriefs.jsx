import React from "react";
import axios from "axios";
import Cookies from "universal-cookie";
import QuickChart from "quickchart-js";
import { useState,useEffect } from "react";
function AvancementBriefs(){

const [AllBriefs,setAllBriefs]=useState([]);
const cookies = new Cookies()

useEffect(() => {
    let idFormateur = cookies.get("FormateurID");


    const AvancementBrief = async () => {
        await axios
          .get("http://localhost:8000/api/Groupe/" + idFormateur)
          .then((res) => {           
            setAllBriefs(res.data.ListBrifes);
          });
      };
      AvancementBrief();

}, []);


const ChartBrifes = new QuickChart();

ChartBrifes.setConfig({
  type: "progressBar",
  data: {
    datasets: [
      {
        data: AllBriefs.map((value) => value.Percentage),
        backgroundColor: "green",
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

const BriefImage = ChartBrifes.getUrl();


    return(
        <div className="col-6 border border-dark">
        <h2>Etat d'avencement de brief :</h2>
        {AllBriefs.map((value) => (
          <div key={Math.random()}>
            <li key={Math.random()}>{value.Nom_du_brief}</li>
          </div>
        ))}
        <img style={{ width: 300 }} src={BriefImage}></img>
      </div>
    )
}
export default AvancementBriefs