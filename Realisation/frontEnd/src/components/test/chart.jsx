import { render } from "@testing-library/react";
import QuickChart from "quickchart-js";
import React from "react";
import Cookies from "universal-cookie";
import { useEffect,useState } from "react";
import axios from "axios";

function ChartBar (props){
    const myChart = new QuickChart();
     
    
    const [DataGroupes, setDataGroupes] = useState([]);
    const [Porsontage, setPorsontage] = useState([]);
    const [OneGroupe, setOneGroupe] = useState([]);
    const [Apprenants, setApprenants] = useState([]);
    const [NumberApprenant, setNumberApprenant] = useState([]);
    const [IdGroupe, setIdGroupe] = useState([]);
    const cookies = new Cookies();



    
    useEffect(() => {
            // console.log( props.dataApp)
         
         
     
   
     // Api One Groupe 
     const OneGroupe=async()=>{
        await  axios.get("http://localhost:8000/api/OneGroupe/"+cookies.get('FormateurID'))
        .then(res=>{
            setOneGroupe(res.data[0])
            setNumberApprenant(res.data[1])
            setApprenants(res.data[2])
         
            })

    
    }
    OneGroupe()
    Apprenants.map((value)=>{
        axios.get("http://localhost:8000/api/Av_ApprenantTache/"+cookies.get('FormateurID')+"/"+cookies.get('GroupeID')+"/"+1+"/1")
        .then(res=>{
            //    setDataGrous(res.data)
            
            setPorsontage(res.data[0])
          })
        })
        console.log(Porsontage)
}, []);


    myChart.setConfig({


  
        type: 'progressBar',
        data: {
          datasets: [
            {
              data: [Porsontage],
            },
          ],
        },
        options: {
          plugins: {
            datalabels: {
              font: {
                size: 30,
              },
              color: (context) => context.dataset.data[context.dataIndex] > 15? '#fff' : '#000',
              anchor: (context) => context.dataset.data[context.dataIndex] > 15 ? 'center' : 'end',
              align: (context) => context.dataset.data[context.dataIndex] > 15 ? 'center' : 'right',
            },
          },
        },
      
    });
    const chartImage = myChart.getUrl();

    // console.log(props.DataChart)

    // console.log(chartImage)
 return(
    <div>

           <img style={{width:300}} src={chartImage}></img>
    </div>
 )   

}

export default ChartBar;