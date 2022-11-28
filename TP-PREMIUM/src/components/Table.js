import React from "react";
import axios from 'axios';

class Table extends React.Component{

    state={
        Nom_de_la_tache:[],
        id:'',
        data:[],
    }

    componentDidMount(){


        axios.get("http://127.0.0.1:8000/api/task")
        .then(res=>{
            this.setState({
           data:res.data
        })
        })
    }

    handleChange=(event)=>{
        this.setState({
            Nom_de_la_tache:event.target.value
        })
    }

    handleSubmit=()=>{
        // console.log('ff')
        axios.post('http://127.0.0.1:8000/api/task',this.state)
        .then((res)=>{
            alert('data has been Add')
            window.location.reload(false)
        })
      
    }

    handleDelete=(id)=>{
        axios.delete('http://127.0.0.1:8000/api/task/'+id)
        .then((res)=>{
            alert('data has been deleted')
            window.location.reload(false)
        })
    }

    handleEdit=(id)=>{
        axios.get('http://127.0.0.1:8000/api/task/'+id+'/edit')
        .then(res=>{
            console.log(res.data)
                this.setState({
                    Nom_de_la_tache:res.data.Nom_de_la_tache,
                    id:res.data.id
                })
            
        })
       
        let btnAdd= document.querySelector("#btnAdd");
        let btnUpdate = document.querySelector('#btnUpdate');
            
       
            // btn.setAttribute("type", "submit");
            btnAdd.style.display = "none"
            btnUpdate.style.display = "inline"
        }
        handleUpdate=(id)=>{
            console.log(id)
            axios.put('http://127.0.0.1:8000/api/task/'+id,this.state)
            .then((res)=>{
                alert('data has been updated')
                window.location.reload(false)
            })
        }

    render() {

      
        return (
            <div>
               Task <input type="text" value={this.state.Nom_de_la_tache}  onChange={this.handleChange} ></input>
               <br></br>
               {/* Start date <input type="datetime-local"></input><br>
                </br>
               end date <input type="datetime-local"></input> */}
                <button id="btnAdd" className="btn btn-primary" onClick={this.handleSubmit}>ajouter</button>
                <br></br>
                <button id="btnUpdate" style={{display:"none"}} className="btn btn-warning"  onClick={()=>this.handleUpdate(this.state.id)}>update</button>

            <table className="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Task</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {this.state.data.map((task)=>(
                        <tr id='tr' key={task.id} >
                            <td>{task.id} </td>
                            <td >{task.Nom_de_la_tache} </td>
                            <td><button className="btn btn-danger" onClick={(()=>this.handleDelete(task.id))}>delete</button> </td>
                            <td><button className="btn btn-warning" onClick={(()=>this.handleEdit(task.id))}>Edit</button> </td>
                        </tr>
                    ))}
                </tbody>
            </table>
            </div>
        );
    }
}
export default Table ;