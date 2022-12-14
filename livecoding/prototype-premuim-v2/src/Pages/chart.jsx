import React from "react";
import { Bar,Line}from "react-chartjs-2"
import { Chart}from "chart.js/auto"
import axios from "axios";


class ChartBar extends React.Component{

    state = {
        Data:[],
       
     
    }

    componentDidMount(){
        axios.get('http://127.0.0.1:8000/api/task')
        .then(res=>
            // console.log(res.data)
            this.setState({
                Data:res.data,
                
            })
            )
        }
    render(){
        console.log(this.state)
        return(
            <div style={{width:600}}>
        <Line data={{
                labels:this.state.Data.map((value)=>value.Task),
                datasets:[{
                    label:"duree de tache (/h)",
                    data:this.state.Data.map((value)=>value.Period),
                    indexAxis:'x'
                }]
         }}
          />
        </div>
        )
    }
}
export default ChartBar;