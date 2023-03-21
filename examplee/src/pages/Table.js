import axios from "axios";
import { useEffect, useState } from "react";
import { Link } from "react-router-dom";

const Table = () => {
    const [products,setProducts]=useState([])
    const fetchProducts=async (e) => {
        await axios.get('http://127.0.0.1:8000/api/show/')
        .then(({data})=>{
            setProducts(data)
        })
        .catch(({response})=>{
            console.log(response)
        })
    };
    const destroy=async (id) => {
        await axios.delete('http://127.0.0.1:8000/api/destroy/'+id)
        .then(({data})=>{
            fetchProducts()
        })
        .catch(({response})=>{
            console.log(response)
        })
    };
    useEffect(()=>{
        fetchProducts()
    },[])
    console.log(products)
    return ( 
        <>
            <table className="table w-75 mx-auto table-bordered">
                <thead>
                <tr className="bg-secondary text-center">
                    <th scope="col">#ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
                
                </thead>
                <tbody>
                    {
                    products && (
                        products.map((product,index)=>(
                            <tr key={index} className="text-center">
                                <th scope="row">{product.id}</th>
                                <th>{product.title}</th>
                                <th>{product.descritpion}</th>
                                <th>
                                    <img width='50' src={`http://127.0.0.1:8000/storage/${product.image}`} alt="image" />
                                </th>
                                <th>
                                    <button className="btn btn-outline-danger mx-1" onClick={()=>{destroy(product.id)}}>Delete</button>
                                    <Link className="btn btn-outline-success mx-1" to={`/edite/${product.id}`}>Edite</Link>
                                </th>

                            </tr>
                        ))
                    )
                    }
             
                </tbody>
            </table>
        </>
     );
}
 
export default Table;