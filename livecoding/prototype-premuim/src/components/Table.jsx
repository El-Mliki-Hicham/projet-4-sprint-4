import axios from "axios";
import React from "react";

class Table extends React.Component{

state ={
    data:[],
    Task:'',
    id:''
    
}
async componentDidMount(){
  await axios.get("http://127.0.0.1:8000/api/task")  
  .then(res=>
    // console.log(res.data)
    this.setState({
        data:res.data
    })
        )
}

handleChange=(event)=>{
    this.setState({
        Task: event.target.value
        })
        
        }
    
 handleEdit=(id)=>{
       
    let btnAdd= document.querySelector("#btnAdd");
    let btnUpdate = document.querySelector('#btnUpdate');
        
   
        // btn.setAttribute("type", "submit");
        btnAdd.style.display = "none"
        btnUpdate.style.display = "inline"
               axios.get("http://127.0.0.1:8000/api/task/"+id+'/edit')
               .then(res=>{
                this.setState({
                    Task:res.data.Task,
                    id:res.data.id
                })
            }
               )
        }
    
        handleUpdate=async(e)=>{
           e.preventDefault()

            let id =  this.state.id 
           await axios.put("http://127.0.0.1:8000/api/task/"+id,this.state)
           .then(res=>{
               alert('Data has been updated')
               window.location.reload()
           }
               )
       }

 handleSubmit=async(e)=>{
    e.preventDefault()
    await axios.post("http://127.0.0.1:8000/api/task",this.state)
    .then(res=>{
        alert('Data has been add')
        window.location.reload()
    }
        )
}

handleDelete=async(id)=>{
    

    await axios.delete("http://127.0.0.1:8000/api/task/"+id)
    .then(res=>{
        alert('Data has been delete')
        window.location.reload()
    }
    )
    
}




render(){
    

    return(
        <div>
            <div>
               Task <input type="text" value={this.state.Task} onChange={this.handleChange} />
            <button className="btn btn-primary" id="btnAdd" onClick={this.handleSubmit}>Ajouter</button>
            <button className="btn btn-warning" style={{display:'none'}} id="btnUpdate" onClick={this.handleUpdate}>Update</button>
                </div>
            <table className="table">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Task</td>
                        <td>Date debut</td>
                        <td>Date Fin</td>
                    </tr>
                </thead>
                <tbody>
                    {this.state.data.map((value)=>
                  
                  <tr key={value.id}>
                  <td>{value.id}</td>
                  <td>{value.Task}</td>
                  <td>{value.Date_debut}</td>
                  <td>{value.Date_fin}</td>
                        <td>
                            <button  className="btn btn-warning" onClick={()=>this.handleEdit(value.id)}>edit</button>
                        <button className="btn btn-danger" onClick={this.handleDelete.bind(this,value.id)}>supprimer</button>
                            </td>
              </tr>
                  )}
                  
                </tbody>
            </table>
            {/* Task<input onChange={this.handleChange}></input> */}
        </div>
    )
}

}

export default Table;