import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import MoreResults from './../Common/MoreResults';
import CategoryVideoItem from './../Common/CategoryVideoItem';
import Slider from "react-slick";

export default class CategoryVideos extends Component {

    constructor(props)
    {
        super(props);

        const field = props.field ? JSON.parse(atob(props.field)) : '';

        this.state = {
            field : field,
            items : null,
            loaded: false,
            size:field.settings.maxItems !== undefined && field.settings.maxItems != null ?  field.settings.maxItems : 10,
        };
    }

    componentDidMount() {
        this.query();
    }

    query() {
        const field = this.state.field;
        var self = this;
        const size = this.state.size;
        const category = field.settings.category;
        const categoryQuery = category != null ? "&category_id="+category : '';

        axios.get(ASSETS+'api/contents?size='+size+'&typology_id=' + field.settings.typology + categoryQuery)
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined)
              {
                  self.setState({
                      items : response.data.data,
                  });
              }

          }).catch(function (error) {
             console.log(error);
           });
    }


    renderItems() {

      var result = [];

      const {items,field} = this.state;

      const extended = field.settings.extended != null ? field.settings.extended : false;

      for(var key in items){
        console.log("CategoryVideos => ",items[key]);

        result.push(
          <li key={key}>
            <CategoryVideoItem
              field={items[key]}
              extended={extended}
            />
          </li>
        );
      }

      return result;
    }


    render() {
      const settings = {
        dots: false,
        infinite: false,
        speed: 500,
        slidesToShow: 5,
        slidesToScroll: 1
      };

        return (
            <div>
                {this.state.items == null &&
                    <p>{/*Carregant dades...*/}</p>
                }

                {this.state.items != null && this.state.items.length > 0 &&
                    <ul>
                      <h2>{this.props.categoryName}</h2>
                      <Slider {...settings}>
                        {this.renderItems()}
                      </Slider>
                    </ul>
                }


            </div>
        );
    }
}

if (document.getElementById('category-videos')) {

    document.querySelectorAll('[id=category-videos]').forEach( element => {

      var field = element.getAttribute('field');
      var categoryName = element.getAttribute('categoryName');

      ReactDOM.render(<CategoryVideos
          field={field}
          categoryName={categoryName}
        />, element);
    });
}
