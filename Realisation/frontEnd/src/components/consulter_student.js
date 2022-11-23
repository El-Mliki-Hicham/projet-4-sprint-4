import axios from "axios";
import React, { Component } from "react";
import {useParams} from 'react-router-dom';

function whithParams(Component) {
    return props=><Component {...props} params={useParams()}/>
}
class ConsulterStudent extends React.Component{
    state={
        data:[]
    }

  componentDidMount(){
    const id = this.props.params.briefId
    axios.get("http://127.0.0.1:8000/api/assigner/"+id)
    .then(res=>
        this.setState({
            data: res.data
            })
             )
  }

    render(){

       
        return(
            <section>
                <div>
                <table className="table">
                {this.state.data.map((student)=>(

<div>
<tr>Id : {student.id}</tr>
<tr>First_name :{student.First_name}</tr>
<tr>Last_name :{student.Last_name}</tr>
<tr>Email:{student.Email}</tr>
<br></br>
</div>
))}    
                </table>
                </div>
            </section>
        )
    }

}
export default whithParams(ConsulterStudent);