import React from "react";
import axios from "axios";

import { Bar } from "react-chartjs-2";
import { Chart as chartJs } from "chart.js/auto";



class Chart extends React.Component{


    constructor(props) {
        super(props);
        this.state ={        
        labels:this.props.DataTasks.map((value)=>value.Nom_de_la_tache),
        datasets: [{   
            label:"durée de tâche (/h)", 
            data:this.props.DataTasks.map((value)=>value.Period),
            backgroundColor:["orange"],  
              indexAxis: 'x',   
          }],
        }
    }

  
    render(){ 
        console.log(this.props.DataTasks)
        return(
            <div style={{width:700}}>
                <Bar   data={this.state}/>
            </div>
        )
    }}
export default Chart ;