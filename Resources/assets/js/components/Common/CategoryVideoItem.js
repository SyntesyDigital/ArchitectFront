import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';


class CategoryVideoItem extends Component {

    constructor(props)
    {
        super(props);
        moment.locale(LOCALE);

        //const field = props.field ? JSON.parse(atob(props.field)) : '';
        const linkYoutube = props.field.fields.video.values.url ? props.field.fields.video.values.url[LOCALE] : null;
        var linkYoutubeImage = null;
        if(linkYoutube != null){
          linkYoutubeImage = linkYoutube.split('/');
          linkYoutubeImage = linkYoutubeImage[linkYoutubeImage.length - 1];
        }

        this.state = {
            title : props.field.title,
            link: props.field.url,
            showDate : props.showDate? props.showDate:false,
            date: moment(props.field.fields.video.created_at).format('DD/MM/YYYY h:mm A'),
            linkYoutube : linkYoutube,
            linkYoutubeImage : linkYoutubeImage != null?'https://img.youtube.com/vi/'+linkYoutubeImage+'/mqdefault.jpg':null,
            views : props.field.fields
        };
    }

    render() {
        return (
          <div>
            { this.state.linkYoutube  != null  &&
              <div className="category-video-item-container">
                <div className="video-container">
                  <a href={this.state.link}>
                    <img src={this.state.linkYoutubeImage} className="thumb-video"/>
                  </a>
                </div>
                <div className="text-container">
                  <h4 className="titol">{this.state.title}</h4>
                  { this.state.showDate &&
                    <p className="date">{this.state.date}</p>
                  }
                  <p className="actions">{this.state.views['youtube-views'].values[''] > 1000? Math.round(this.state.views['youtube-views'].values[''] /1000)+' K':this.state.views['youtube-views'].values['']  } |

                   <a href={"https://www.facebook.com/sharer/sharer.php?u="+this.state.linkYoutube+"&t="+this.state.title}
                      className="share-button first-share-btn"
                       onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                       target="_blank" title="Share on Facebook">
                       <i className="fa fa-facebook"></i>
                    </a>

                    <a href={"https://twitter.com/share?url="+this.state.linkYoutube+"&text="+this.state.title}
                      className="share-button"
                       onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                       target="_blank" title="Share on Twitter">
                       <i className="fa fa-twitter"></i>
                    </a>

                    <a href={"mailto:?subject="+this.state.title+"&body="+this.state.linkYoutube}
                      className="mail-button">
                      <i className="fa fa-envelope" ></i>
                    </a>


                  </p>
                </div>
              </div>
            }
          </div>
        );
    }
}

export default CategoryVideoItem;
