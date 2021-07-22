import React from 'react';
import ReactDOM from 'react-dom';
class Example extends React.Component{
    constructor(props) {
        super(props);
        this.state = {
            products:[]
        }
    }
    componentDidMount() {
        fetch("/all-product").then(rs=>rs.json()).then(rs=>{
            this.setState({
                products: rs
            })
        })
    }

    render() {
        const products = this.state.products;
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">Hello World</div>

                            <div className="card-body">I'm an example component!</div>
                            <ul>
                                {products.map((e,k)=>{
                                    return <li key={k}>{e.name}</li>
                                })}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
