// Vue.component('input-file-image', componentLibrary.InputFileImage)

// Vue.component('input-image',{
//    props: {
//        file: String,
//        imageWidth: String,
//        imageHeight: String
//    },
//    methods: {
//        onChange(e) {
//            const reader = new FileReader()
//            reader.addEventListener('load', () => {
//                this.$emit('update:file', reader.result)
//            })
//            if(e.target.files.length === 1) {
//                reader.readAsDataURL(e.target.files[0])
//            }
//        }
//    },
//    template:   `<div>
//                    <div class="d-ib va-b">
//                        <div class="px-0_5em btn-file" style="width: 11.6em;" :class="{ 'button': !file }">
//                            <img :src="file" :style="{ 'max-width': imageWidth, 'max-height': imageHeight }" class="va-b" style="margin-bottom:10px">
//                            <span v-if="!file">
//                             <input type="file" accept=".png, .jpg, .gif, .jpeg, .bmp" @change="onChange" required>
//                           </span>
//                            <span v-else>
//                             <input type="file" accept=".png, .jpg, .gif, .jpeg, .bmp" @change="onChange">
//                           </span>
//                        </div>
//                    </div>
//                 </div>`
// });

const app = new Vue ({
  el: '#app',
  components: {
    // InputFileImage
  },
  data: {
    departments: '',
    doctors: '',
    dealers: [{
      id: null,
      title: null,
      excerpt: null,
      qual: null,
      post: null,
      expr: null,
      dept: null
    }],
    schedules: [{
      id: null,
      faculty_id: null,
      day: null,
      from_time: null,
      to_time: null,
      location: null
    }],
    days:['Mon','Tue','Wed','Thu','Fri','Sat','Sun']
  },
  methods: {
    addRow() {
      this.dealers.push({
        id: null,
        title: null,
        excerpt: null,
        qual: null,
        post: null,
        expr: null,
        dept: null
      })
    },
    deleteRow(index,data) {
      this.dealers.splice(index, 1)
      // console.log(data)
      if(data.id)
      {
       this.removeDealer(data)
     }
   },
   saveDealer(dealers) {
      //console.log(dealers)
            
      let postData = {
        dealers: this.dealers
      }
      axios.post('store', postData).then(response => {
        this.fetchPlacement()
        this.$snotify.success('Saved Successfully')                    
      })
    },
    removeDealer(item) {
      axios.delete(`remove?id=${item.id}`).then(response => {
        this.fetchPlacement()
        this.$snotify.error('Deleted Successfully')
      })
    },
    fetchPlacement() {
      axios.get('getData').then(response => {
        if(response.data.length>0){
          this.dealers = response.data             
        }              
      })
    },
    getDept() {
      axios.get('getDept').then(response => {
        if(response.data.length>0){
          this.departments = response.data
        }
      })
    },



    addScheduleRow() {
      this.schedules.push({
        id: null,
        faculty_id: null,
        day: null,
        from_time: null,
        to_time: null,
        location: null
      })
    },
    deleteScheduleRow(index,data) {
      this.schedules.splice(index, 1)
      // console.log(data)
      if(data.id)
      {
       this.removeSchedule(data)
     }
   },
   saveSchedule(schedules) {
      //console.log(schedules)      
      let postData = {
        schedules: this.schedules
      }
      axios.post('store', postData).then(response => {
        this.fetchPlacement()
        this.$snotify.success('Saved Successfully')                    
      })
    },
    removeSchedule(item) {
      axios.delete(`remove?id=${item.id}`).then(response => {
        this.fetchPlacement()
        this.$snotify.error('Deleted Successfully')
      })
    },
    fetchSchedule() {
      axios.get('getData').then(response => {
        if(response.data.length>0){
          this.schedules = response.data             
        }              
      })
    },
    getDoctor() {
      axios.get('getDoctor').then(response => {
        if(response.data.length>0){
          this.doctors = response.data
        }
      })
    },

  },
  created() {
    this.fetchPlacement()
    this.getDept()
    this.fetchSchedule()
    this.getDoctor()
  }
})

