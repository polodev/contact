<template>
  <form method="POST" action="/projects" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
      <div class="field">
          <p class="control has-icons-left">
            <input class="input" name="name" type="text" placeholder="Name" v-model="form.name">
            <span class="icon is-small is-left">
              <i class="fa fa-user"></i>
            </span>
          </p>
          <span class="help is-danger" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
        </div>
        <div class="field">
          <p class="control has-icons-left">
            <input class="input" name="username" type="text" placeholder="username(slug)" v-model="form.username">
            <span class="icon is-small is-left">
              <i class="fa fa-id-card"></i>
            </span>
          </p>
          <span class="help is-danger" v-if="form.errors.has('username')" v-text="form.errors.get('username')"></span>
        </div>
        <div class="field has-addons">
          <label class="label single_left_label">gender</label>
          <p class="control">
            <span class="select">
              <select v-model="form.gender" name="gender">
                <option v-bind:value="1" selected>male</option>
                <option v-bind:value="0">female</option>
              </select>
            </span>
          </p>
        </div>

        <div class="field">
          <p class="control has-icons-left">
            <input class="input" name="city" type="text" placeholder="City" v-model="form.city">
            <span class="icon is-small is-left">
              <i class="fa fa-building"></i>
            </span>
          </p>
        </div>

        <div class="field">
          <p class="control has-icons-left">
            <input class="input" name="relation" type="text" placeholder="Relation" v-model="form.relation">
            <span class="icon is-small is-left">
              <i class="fa fa-users"></i>
            </span>
          </p>
        </div>

        <div class="field">
          <p class="control has-icons-left">
            <input class="input" name="designation" type="text" placeholder="Designation" v-model="form.designation">
            <span class="icon is-small is-left">
              <i class="fa fa-cubes"></i>
            </span>
          </p>
        </div>

        <div class="field">
          <p class="control has-icons-left">
            <input class="input" name="mobile" type="text" placeholder="Mobile" v-model="form.mobile">
            <span class="icon is-small is-left">
              <i class="fa fa-mobile"></i>
            </span>
          </p>
          <span class="help is-danger" v-if="form.errors.has('mobile')" v-text="form.errors.get('mobile')"></span>
        </div>

        <div class="field">
          <p class="control has-icons-left">
            <input class="input" name="email" type="email" placeholder="Email" v-model="form.email">
            <span class="icon is-small is-left">
              <i class="fa fa-envelope"></i>
            </span>
          </p>
        </div>

        <div class="field">
          <p class="control has-icons-left">
            <input class="input" name="facebook" type="text" placeholder="Facebook" value="http://facebook.com/" v-model="form.facebook">
            <span class="icon is-small is-left">
              <i class="fa fa-facebook"></i>
            </span>
          </p>
        </div>

        <div class="field">
          <p class="control has-icons-left">
            <input class="input" name="twitter" type="text" placeholder="Twitter" value="http://twitter.com/" v-model="form.twitter">
            <span class="icon is-small is-left">
              <i class="fa fa-twitter"></i>
            </span>
          </p>
        </div>

        <div class="field">
          <p class="control has-icons-left">
            <input class="input" name="linkedin" type="text" placeholder="LinkedIn" value="http://linkedin.com/" v-model="form.linkedin">
            <span class="icon is-small is-left">
              <i class="fa fa-linkedin"></i>
            </span>
          </p>
        </div>
        <div class="field">
          <p class="control">
            <textarea class="textarea" name="address" type="text" placeholder="Address"></textarea>
          </p>
        </div>
        <div class="field">
          <label class="label">User Avatar</label>
          <p class="control">
          <input type="file" name="avatar">
          </p>
        </div>
        <div class="field">
          <label class="label">About</label>
          <p class="control">
            <textarea class="textarea" name="about" type="text" placeholder="about" v-model="form.about"></textarea>
          </p>
        </div>

      <div class="control">
          <button class="button is-primary" :disabled="form.errors.any()">update</button>
      </div>
  </form>
</template>
<script>
  export default {
    props: ['contact'],
    data () {
      return {
        response: false,
        form: new Form({
            name: this.contact.name,
            username: this.contact.username,
            gender: this.contact.gender,
            city: this.contact.city,
            relation: this.contact.relation,
            designation: this.contact.designation,
            mobile: this.contact.mobile,
            email: this.contact.email,
            facebook: this.contact.facebook,
            twitter: this.contact.twitter,
            linkedin: this.contact.linkedin,
            address: this.contact.address,
            avatar: this.contact.avatar,
            about: this.contact.about,
        })
      }
    },
    methods: {
      onSubmit() {
        self = this;
        this.form.patch('/profile/' + this.contact.slug)
           .then(response => {
            return location.href = '/'
           });
      }
    },
  }
</script>
