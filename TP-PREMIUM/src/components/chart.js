import React from "react";
import axios from "axios";

import { Bar } from "react-chartjs-2";
import { Chart as chartJs } from "chart.js/auto";



class Chart extends React.Component{
    state ={
        
        // star tehtani
        labels:this.props.DataTasks.map((value)=>value.Task),
        // data li hatkon f lwest
        datasets: [{ 
            // l3onwan 
            label:"durée de tâche (/h)",
            // star d l ar9am
            data: this.props.DataTasks.map((value)=>value.Period),
            //color 
            backgroundColor:["blue"],
            //position
              indexAxis: 'x',
          
          }],
        }

          


    render(){
        // const dataPeriod = this.props.DataTasks.map((value)=>value.Period)
        
        
        return(
            <div style={{width:600}}>
                <Bar data={this.state}/>
            </div>
        )
    }
}
export default Chart ;