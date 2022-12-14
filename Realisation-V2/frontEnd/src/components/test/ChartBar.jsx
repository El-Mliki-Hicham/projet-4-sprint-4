
import QuickChart from "quickchart-js";
import React from "react";
import Cookies from "universal-cookie";
import { useEffect,useState } from "react";
import axios from "axios";

class ChartBar2 extends React.Component{

    constructor(props){
        super(props);
        this.state={
            Groupe:[],
            NumbreApp:[],
            Apperenant:[],
            Porsentage:[]
        }
    }
   static getDerivedStateFromProps(props,state){
            return {
               Apperenant : props.dataApp
            }
    }



    componentDidMount(){
        const myChart = new QuickChart();
        const cookies = new Cookies();
        // Api One Groupe 
       
            axios.get("http://localhost:8000/api/Av_ApprenantTache/"+cookies.get('FormateurID')+"/"+cookies.get('GroupeID')+"/"+2+"/1")
            .then(res=>{
                //    setDataGrous(res.data)
                
                this.setState(
                    {
                     Porsentage: res.data[0]
                    }
                        )
            })
     
    }

    render(){
        console.log(this.state)
        return(
            <div>hello</div>
        )
    }
}

export default ChartBar2;