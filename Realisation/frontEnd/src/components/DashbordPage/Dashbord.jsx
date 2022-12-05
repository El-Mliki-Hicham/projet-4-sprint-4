import React from "react";
import Cookies from "universal-cookie";
import { useEffect,useState } from "react";
import axios from "axios";
function Dashbord() {
    const [DataGroupes, setDataGroupes] = useState([]);
    const [OneGroupe, setOneGroupe] = useState([]);
    const [Apprenants, setApprenants] = useState([]);
    const [NumberApprenant, setNumberApprenant] = useState([]);
    const [IdGroupe, setIdGroupe] = useState([]);
    const cookies = new Cookies();

    useEffect(() => {
        let idFormateur =  cookies.get('FormateurID')
       
        

        //Api  anné Scolaire
        const DataGroupes = async () => {
         await axios.get("http://localhost:8000/api/AllGroupes/"+idFormateur)
        .then(res=>{
            setDataGroupes(res.data)
            // console.log(res.data)
        })
    }
       DataGroupes()

        // Api One Groupe 
        const OneGroupe=async()=>{
        await  axios.get("http://localhost:8000/api/OneGroupe/"+idFormateur)
        .then(res=>{
            setOneGroupe(res.data[0])
            setNumberApprenant(res.data[1])
            setApprenants(res.data[2])
            // console.log(res.data)
            cookies.set('GroupeID', res.data[0].idGroupe)
            })

    
    }
    OneGroupe()
     setIdGroupe(cookies.get('GroupeID'))

    //  api Avoncement apprenants
    const AvoncementApprenant = async () => {
        console.log(IdGroupe)
        await axios.get("http://localhost:8000/api/ApprenantBrief/"+idFormateur+'/'+cookies.get('GroupeID'))
       .then(res=>{
        //    setDataGrous(res.data)
           console.log(res.data)
       })
   }
   AvoncementApprenant()

    }, []);

    //selection avec anné scolaire
   function selectDate(e){
    let idGroupe = e.target.value 
    axios.get("http://localhost:8000/api/groupes/"+ idGroupe)
    .then(res=>{
       
        console.log(res.data)
    })
    
        
    }

    return(
        <div>
            <select onChange={selectDate} name="" id="">
                {DataGroupes.map((value)=>
                <option key={value.id}  value={value.id}>{value.Annee_scolaire}</option>
                )}
            </select>
            <br />
            {OneGroupe.Nom_groupe}
            <br />
             numbre des apprenants: {NumberApprenant}
           <div style={{border:"23"}}>
            id groupe : {IdGroupe}
            <br />
            Etat d'avoncement : <br />
            {Apprenants.map((apprenant)=>
            <li key={apprenant.id}>{apprenant.Nom} {apprenant.Prenom} </li>
            )}

           </div>
        </div>
    )
}
export default Dashbord;