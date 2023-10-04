<template>
   <div class="container mt-5">
  <h2>Contact Us</h2>
  <form id="contactForm">
    <div class="mb-3">
      <label for="name" class="form-label">Your Name</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Your Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
      <label for="message" class="form-label">Message</label>
      <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
    </div>
    <button type="button" class="btn btn-primary" v-on:click="onSubmit">Submit</button>
  </form>
</div>
</template>

<script>
   export default {
    props: ['title','description'],
   /* ready: function() {
       alert("hi...");
    },*/
   data: () => ({
    loading:false,
    loading_text:'Loading...',

    form:{

        name:'test',
        phone:'fdsfdsfds',
        email:'sss',
        subject:'sss',
        message:'ddd',



    },
     notices_data:[],
     notices:[],

    }),
    mounted:function() {

console.log('mounted...')

  },
    methods: {

        onSubmit:function(){
   /*          if(this.form.name==''||this.form.email==''||this.form.subject==''||this.form.message==''){
                swal({
                            type: 'error',
                            title: 'Required Fields',
                            text: 'All fields are required, please fill and try again.',
                            footer: ''
                          });
                return 0;
            } */
          //  e.preventDefault();
           // const formData = this.form; // Get the form data from the component's data object

            let formData = new FormData();
           // formData.append('news_letter_email',this.form.email);
              formData = this.form;
              this.loading=true;
   this.loading_text='Sending email please wait!';
    axios.post('/contact', formData) // Send a POST request to the backend API with the form data
      .then(response => {
        alert(response.data.result.name);
       this.loading=false;
       this.loading_text='Loading....';
   /*  let instance = Vue.$toast.open(response.data.message);
 */
    this.form.name=''
        this.form.email=''
        this.form.subject=''
        this.form.message=''
        // Handle the response from the server
      })
      .catch(error => {
        // Handle any errors that occurred during the request
      });



        }




    },

}
</script>
