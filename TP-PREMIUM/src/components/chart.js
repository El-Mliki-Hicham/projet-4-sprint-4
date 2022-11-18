import React from "react";
import axios from "axios";

import { Bar } from "react-chartjs-2";
import { Chart as chartJs } from "chart.js/auto";



class Chart extends React.Component{
    state ={
        
        labels:this.props.DataTasks.map((value)=>value.Task),
       
        datasets: [{ 
          
            label:"durée de tâche (/h)",
          
            data: this.props.DataTasks.map((value)=>value.Period),
         
            backgroundColor:["blue"],
          
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