import QuickChart from 'quickchart-js';
import React from 'react';
import Cookies from "universal-cookie";
import {
    useEffect,
    useState
} from "react";
import axios from "axios";

function Dashbord() {
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
        const DataGroupes = async () => {
            await axios.get("http://localhost:8000/api/AllGroupes/" + idFormateur)
                .then(res => {
                    setDataGroupes(res.data)
                    // console.log(res.data)
                })
        }
        DataGroupes()

        // Api One Groupe
        const OneGroupe = async () => {
            await axios.get("http://localhost:8000/api/OneGroupe/" + idFormateur)
                .then(res => {
                    setOneGroupe(res.data[0])
                    setNumberApprenant(res.data[1])
                    setApprenants(res.data[2])
                    setPourcentage(res.data[3].toFixed(0))
                    setAllBriefs(res.data[4])
                    // console.log(res.data)

                    cookies.set('GroupeID', res.data[0].idGroupe)
                })
        }
        OneGroupe()
        setIdGroupe(cookies.get('GroupeID'))
    }, []);

    //selection avec anné scolaire
    function selectDate(e) {
        let idGroupe = e.target.value
        axios.get("http://localhost:8000/api/groupes/" + idGroupe)
            .then(res => {
                setOneGroupe(res.data[0][0])
                setNumberApprenant(res.data[1])
                setAllBriefs(res.data[2])
                console.log(res.data)
            })

            //Avancement groupe after select data
        axios.get("http://localhost:8000/api/AvancementGroups/" + idGroupe)
            .then(res => {
                setPourcentage(res.data.toFixed(0))
                
                  
            })
            
        }
        const myChart = new QuickChart();
       
        myChart.setConfig({
    
    
    
            type: 'progressBar',
            data: {
              datasets: [
                {
                  data: [Pourcentage],
                },
              ],
            },
            options: {
              plugins: {
                datalabels: {
                  font: {
                    size: 30,
                  },
                  color: (context) => context.dataset.data[context.dataIndex] > 15? '#fff' : '#000',
                  anchor: (context) => context.dataset.data[context.dataIndex] > 15 ? 'center' : 'end',
                  align: (context) => context.dataset.data[context.dataIndex] > 15 ? 'center' : 'right',
                },
              },
            },
          
        });
        
            const chartImagee = myChart.getUrl();    
            // 
        const ChartBrifes = new QuickChart();
       
        ChartBrifes.setConfig({
    
    
    
            type: 'progressBar',
            data: {
                datasets: [
                {
                    data: AllBriefs.map((value)=>value.Percentage),
                    backgroundColor: 'green',
                },
              ],
            },
          
            options: {
              plugins: {
                datalabels: {
                    
                        formatter: (val) => {
                          return val.toLocaleString()+  "%";
                        },
                     
                     
                  font: {
                    size: 30,
                  },
                  color: (context) => context.dataset.data[context.dataIndex] > 15? '#fff' : '#000',
                  anchor: (context) => context.dataset.data[context.dataIndex] > 15 ? 'center' : 'end',
                  align: (context) => context.dataset.data[context.dataIndex] > 15 ? 'center' : 'right',
                },
              },
            },
          
        });
        
            const BriefImage = ChartBrifes.getUrl();    
            
            return(
    <div>
        <div className="container">
            <div className="row">
                <div className="col-sm-9">
                    <h1>Tableau de borde d’état d’avancement</h1>
                </div>
                <div className="col-sm">
                    <select onChange={selectDate} name="" id="">
                        {DataGroupes.map((value)=>
                        <option key={value.id} value={value.id}>{value.Annee_scolaire}</option>
                        )}
                    </select>
                </div>
    
            </div>
            <div style={{border:"23"}}>
    
                <br />
    
    
            </div>
           
            <div className="container groupee"  id='group'>
                <div className="row border border-primary">
                    <div className="col-sm">
                        image
                    </div>
                    <div className="col-sm">
                        {OneGroupe.Nom_groupe}
                    </div>
                    <div className="col-sm">
                        numbre des apprenants: {NumberApprenant}
                    </div>
                    <div className="col-sm">
                        {OneGroupe.Annee_scolaire}
                    </div>
                </div>
                    <br />
                         <div className="row">
                         <div className="col-6 border border-dark ">
                            <h2>Etat d' avancement du groupe:</h2>
                            <img style={{width:300}} src={chartImagee}></img>
                        </div>
                   
                        
                        <div className="col-6 border border-dark">Column</div>
                        <div className="col-6 border border-dark">
                            <h2>Etat d'avencement de brief :</h2>
                            {AllBriefs.map((value)=> <div>
                            <li key={value.id}>{value.Nom_du_brief}</li>
                            </div>
                            
                            )}
                            <img style={{width:300}} src={BriefImage}></img>
                        </div>
                       
                 </div>
            </div>
    
         

    
    
        </div>
    </div>
    )
}
export default Dashbord;