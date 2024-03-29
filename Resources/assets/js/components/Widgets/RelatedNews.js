import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import NewsRelated from './../Typologies/NewsRelated';


export default class RelatedNews extends Component {

    constructor(props)
    {
        super(props);

        const tags = props.tags ? JSON.parse(props.tags) : '';
        const category = props.category ? props.category : '';
        const content = props.content ? props.content : '';

        this.state = {
            category : category,
            items : null,
            tags : tags,
            content : content
        };
    }

    componentDidMount() {

        const {filters} = this.state;

        this.query(1,filters);
    }

    query(page,filters) {
        var self = this;

        const {category} = this.state;

        var params = {
            size : 10,
            typology_id : 1,
            category_id : category,
            accept_lang : LOCALE,
            order : 'date,desc',
            loads : 'category'
        };

        axios.post(ASSETS+'api/contents',params)
          .then(function (response) {

              if(response.status == 200
                  && response.data.data !== undefined)
              {
                  self.setState({
                      items : response.data.data,
                      lastPage : response.data.meta.last_page,
                      currPage : response.data.meta.current_page,
                      filters : filters
                  });
              }


          }).catch(function (error) {
             console.log(error);
           });
    }

    shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]]; // eslint-disable-line no-param-reassign
        }
    }

    render() {
      var result = [];
      const {items, content} = this.state;

      if(items != null && items.length > 0){
            this.shuffleArray(items);
            console.log('Shuffled related results =>',items);
      }

      var classEntrevista = 'item_blog col-md-4 col-sm-4 col-xs-12';
      var count = 0;
      for(var key in items){
        // CONTROLAR QEU AQUI NO SEA LA MISM NOTICIA QUE MOSTRAMOS
        console.log("TypologyPaginated => ", content);
        if(items[key].id != content && count < 3){

          result.push(
            <div className="col-md-6" key={key}>
              <NewsRelated
                field={items[key]}
              />
            </div>
          );
          count = count + 1;

        }
      }



      return (

          <div className="other-posts">
            <h3>SUR LE MÊME SUJET</h3>

            {result}

          </div>
      );
    }
}


if (document.getElementById('related-news')) {

    document.querySelectorAll('[id=related-news]').forEach( element => {

        var tags = element.getAttribute('tags');
        var category = element.getAttribute('category');
        var content = element.getAttribute('content');

        ReactDOM.render(<RelatedNews
            tags={tags}
            category={category}
            content={content}
          />, element);
    });
}
