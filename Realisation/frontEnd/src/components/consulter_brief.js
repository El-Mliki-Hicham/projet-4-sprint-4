import axios from "axios";
import React, { Component } from "react";
import {useParams} from 'react-router-dom';

function whithParams(Component) {
    return props=><Component {...props} params={useParams()}/>
}
class ConsulterBrief extends React.Component{
    state={
        brief:"" ,
        NumbreTask : ""
    }


   async componentDidMount(){
         const id = this.props.params.briefId;
        await axios.get('http://127.0.0.1:8000/api/brief/'+id)
        .then((res)=>
                this.setState({
                brief : res.data.brief,
                NumbreTask : res.data.count
            })
        )
    }
    render(){

        console.log(this.state) 
        const brief =this.state.brief
        const NumbreTask  =this.state.NumbreTask
        return(
            <section>
                <div>
                <table className="table">
                    
                    <tbody>
                        
                       
                            <tr> id : {brief.id}</tr>
                            <tr> nom de brief : {brief.Nom_du_brief}</tr>
                            <tr> Date heure de livraison 	: {brief.Date_heure_de_livraison}</tr>
                            <tr> Date heure de récupération : {brief.Date_heure_de_récupération}</tr>
                            <tr> Nombre de taches  : {NumbreTask.Count} <a href={"/consulterTache/"+brief.id} className="btn btn-info" > + Consulter</a></tr>

                        
                        
                    </tbody>
                </table>

                <br>
                </br>
                <a href={"/consulterStudent/"+brief.id}  className="btn btn-warning">+plus</a>
                </div>
            </section>
        )
    }

}
export default whithParams(ConsulterBrief);