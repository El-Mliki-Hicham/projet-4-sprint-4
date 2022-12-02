import axios from "axios";
import React from "react";

class Table extends React.Component{

    state = {
        Data:[],
        Task:"",
        id:""
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
        
        handleClick=()=>{
            axios.post("http://127.0.0.1:8000/api/task/store",this.state)
            .then(res=>{
                alert('sucess')
            window.location.reload()
            }
            )/////hadiii fo9aniya lae 
        }
        handleChange=(input)=>{
            
        this.setState({
            Task:input.target.value
            })
    }

  
  
    handleDelete=(id)=>{
        axios.delete('http://127.0.0.1:8000/api/task/delete/'+id)
        .then(res=>{
            alert("data has been deleted")
            window.location.reload()

        })
}
  
  
    handleEdit=(id)=>{
        axios.get("http://127.0.0.1:8000/api/task/"+id)
        .then(res=>{
            this.setState({
            Task:res.data.Task,
            id:res.data.id
        })
        })
    }

    handleUpdate=()=>{
        let id = this.state.id
        axios.put("http://127.0.0.1:8000/api/task/update/"+id,this.state)
        .then(res=>{
            alert("data has updated")
            window.location.reload()
        })
    }


    render(){
console.log(this.state)
        return(
            <div>
                <input type="text" value={this.state.Task}  onChange={this.handleChange}/>
                <button onClick={this.handleClick}>Ajouter</button>
                <button onClick={this.handleUpdate}>Modifier</button>
                <table>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Task</th>
                        </tr>
                    </thead>
                    <tbody>
                        {this.state.Data.map((value)=>
                        <tr key={value.id}>
                            <td>{value.id}</td>
                            <td>{value.Task}</td>
                            <td>
                                <button onClick={this.handleDelete.bind(this,value.id)}>suprimer</button>
                                <button onClick={this.handleEdit.bind(this,value.id)}>Editer</button>
                            </td>

                        </tr>
                        )}
                    </tbody>
                </table>
            </div>
        )
    }
}

export default Table ;