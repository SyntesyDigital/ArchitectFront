import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import MoreResults from './../Common/MoreResults';
import CategoryVideoItem from './../Common/CategoryVideoItem';
import Slider from "react-slick";

export default class RelatedVideos extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
            videoId : props.videoId,
            category : props.category,
            typology : props.typology,
            items : null,
            loaded: false,
            size: 10,
        };
    }

    componentDidMount() {
        this.query();
    }

    query() {
        const typology = this.state.typology;
        var self = this;
        const size = this.state.size;
        const category = this.state.category;
        const categoryQuery = category != null ? "&category_id="+category : '';

        axios.get(ASSETS+'api/contents?size='+size+'&typology_id=' + typology + categoryQuery)
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

      const items = this.state.items;

      const extended = false;

      for(var key in items){
        console.log("RelatedVideos => ",items[key]);
        if(items[key].id != this.state.videoId){
          result.push(
            <li key={key}>
              <CategoryVideoItem
                field={items[key]}
                extended={extended}
              />
            </li>
          );
        }
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
                      <h2>Similar Videos</h2>
                      <Slider {...settings}>
                        {this.renderItems()}
                      </Slider>
                    </ul>
                }


            </div>
        );
    }
}

if (document.getElementById('related-videos')) {

    document.querySelectorAll('[id=related-videos]').forEach( element => {

      var category = element.getAttribute('category');
      var typology = element.getAttribute('typology');
      var videoId = element.getAttribute('videoId');

      ReactDOM.render(<RelatedVideos
          videoId={videoId}
          category={category}
          typology={typology}
        />, element);
    });
}
