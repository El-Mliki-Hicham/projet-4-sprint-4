import QuickChart from 'quickchart-js';
import React from 'react';
import Cookies from "universal-cookie";
import {
    useEffect,
    useState
} from "react";
import axios from "axios";

function AvancemendtApprenant(){
    const [DataGroupes, setDataGroupes] = useState([]);
    const [Pourcentage, setPourcentage] = useState([]);
    const [chartImage, setChartImage] = useState();
    const [AllBriefs,setAllBriefs] = useState([]);
    const [OneGroupe, setOneGroupe] = useState([]);
    const [Apprenants, setApprenants] = useState([]);
    const [NumberApprenant, setNumberApprenant] = useState([]);
    const [IdGroupe, setIdGroupe] = useState([]);
    const cookies = new Cookies();


    useEffect(() => {
        

        let idFormateur = cookies.get('FormateurID')

        //Api anné Scolaire
        const OneGroupe = async () => {
            await axios.get("http://localhost:8000/api/OneGroupe/" + idFormateur)
                .then(res => {
                    // setOneGroupe(res.data[0])
                    // setNumberApprenant(res.data[1])
                    setApprenants(res.data[2])
                    // setPourcentage(res.data[3].toFixed(0))
                    setAllBriefs(res.data[4])
                    console.log(res.data)

                    cookies.set('GroupeID', res.data[0].idGroupe)
                })
        }
        OneGroupe()



    }, []);


    return(
        <div>
            
        </div>
    )
}
