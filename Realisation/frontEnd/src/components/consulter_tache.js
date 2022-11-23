import axios from "axios";
import React, { Component } from "react";
import {useParams} from 'react-router-dom';

function whithParams(Component) {
    return props=><Component {...props} params={useParams()}/>
}
class ConsulterTache extends React.Component{
    state={
        brief:"" ,
        NumbreTask : "",
        data: []
    }


    async componentDidMount(){

        const id =  this.props.params.briefId

        await axios.get("http://127.0.0.1:8000/api/brief/"+ id)
        .then((res)=>
        this.setState({
            data : res.data.brief.tasks
            
        })
        )
    }

  
    render(){

       console.log(this.state.data)
        return(
            <section>
                <div>
                <table className="table">
                {this.state.data.map((task)=>(

                    <div>
                    <tr>Id : {task.id}</tr>
                    <tr>Nom Task :{task.Nom_de_la_tache}</tr>
                    <tr>date debut :{task.Debut_de_la_tache}</tr>
                    <tr>date fin :{task.Fin_de_la_tache}</tr>
                    <br></br>
                    </div>
                ))}    
                
                </table>
                </div>
            </section>
        )
    }

}
export default whithParams(ConsulterTache);