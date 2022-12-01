import React from "react";
import { Bar } from "react-chartjs-2";
import { Chart as ChartJs } from "chart.js/auto";

 class Chart extends React.Component{
    render(){
        console.log(this.props.DataProps)
        return(
            <div style={{width:700}}>
            <Bar   data={{
                  labels:this.props.DataProps.map((value)=>value.Task),

                  datasets:[{
                      label:'dure de tache par /h',
                      data:this.props.DataProps.map((value)=>value.Period) , 
                      backgroundColor:['red'],
                      indexAxis:'y'
                  }]
            }}/>
        </div>

        )
    }

}


export default Chart;