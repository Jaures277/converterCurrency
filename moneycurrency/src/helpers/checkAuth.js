export default function beforeEnter(){
    if (localStorage.getItem("token") == null) {
        return {path:"/"};
    }
  }