import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import MoreResults from './../Common/MoreResults';
import CategoryVideoItem from './../Common/CategoryVideoItem';
import Masonry from 'react-masonry-component';

const masonryOptions = {
    transitionDuration: 0
};
const imagesLoadedOptions = { background: '.my-bg-image-el' }

export default class VideosPaginated extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
            category : props.category,
            typology : props.typology,
            categoryName : props.categoryName,
            items : null,
            lastPage : null,
            currPage : null,
            loaded: false,
            size: 10
        };
    }

    componentDidMount() {
        this.query(1);
    }

    query(page) {
        const field = this.state.field;
        var self = this;
        const size = this.state.size;
        const category =  this.state.category;
        const categoryQuery = category != null ? "&category_id="+category : '';


        axios.get(ASSETS+'api/contents?size='+size+'&typology_id=' + this.state.typology + categoryQuery + '&page=' + (page ? page : null))
          .then(function (response) {
              if(response.status == 200
                  && response.data.data !== undefined)
              {
                  var old_items = self.state.items;
                  if(response.data.meta.current_page != 1){

                    old_items.push.apply(old_items, response.data.data);

                  }else{
                    old_items =response.data.data;
                  }
                  self.setState({
                      items : old_items,
                      lastPage : response.data.meta.last_page,
                      currPage : response.data.meta.current_page,
                  });
              }


          }).catch(function (error) {
             console.log(error);
           });
    }


    renderItems() {

      var result = [];

      const {items,field} = this.state;

      const extended = false;

      for(var key in items){
        console.log("TypologyPaginated => ",items[key]);

        result.push(
          <div className="paginated-video-container col-md-2 col-sm-4 col-xs-6" key={key}>
            <CategoryVideoItem
              field={items[key]}
              extended={extended}
              showDate={true}
            />
          </div>
        );
      }

      return result;
    }

    onPageChange(page) {
        this.query(page);
    }

    render() {

        return (
            <div>
                {this.state.items == null &&
                    <p>{/*Carregant dades...*/}</p>
                }

                {this.state.items != null &&
                    <h2>{this.props.categoryName}</h2>
                }

                {this.state.items != null && this.state.items.length > 0 &&
                  <div className="category-paginated-list">
                      <Masonry
                      disableImagesLoaded={false} // default false
                      updateOnEachImageLoad={false} // default false and works only if disableImagesLoaded is false
                      imagesLoadedOptions={imagesLoadedOptions} // default {}
                      >
                      {this.renderItems()}
                      </Masonry>
                  </div>
                }

                {(this.state.items == null || this.state.items.length <= 0) &&
                    <p className="message-empty">Aucun élément trouvé</p>
                }

                {this.state.lastPage &&
                    <MoreResults
                      currPage={this.state.currPage}
                      lastPage={this.state.lastPage}
                      currentItems={this.state.items.length}
                      onChange={this.onPageChange.bind(this)}
                    />
                }
            </div>
        );
    }
}

if (document.getElementById('videos-paginated')) {

    document.querySelectorAll('[id=videos-paginated]').forEach( element => {

      var category = element.getAttribute('category');
      var typology = element.getAttribute('typology');
      var categoryName = element.getAttribute('categoryName');

      ReactDOM.render(<VideosPaginated
          categoryName={categoryName}
          category={category}
          typology={typology}
        />, element);
    });
}
