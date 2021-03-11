<template>
  <div class="row" style="margin: 40px">
    <div class="col-md-12">
      <ContentTab></ContentTab>
    </div>
  </div>
</template>

<script>
import ContentTab from "./ContentTab";

export default {
  name: "Chat",
  props: ["user"],
  components: {
    ContentTab,
  },
  data() {
    return {
      messages: [],
      newMessage: "",
      users: [],
      activeUser: false,
      typingTimer: false,
    };
  },
  created() {
    this.fetchMessages();
    /*
    Echo.join("chat")
      .here((user) => {
        this.users = user;
      })
      .joining((user) => {
        this.users.push(user);
      })
      .leaving((user) => {
        this.users = this.users.filter((u) => u.id != user.id);
      })
      .listen("MessageSent", (event) => {
        this.messages.push(event.message);
      })
      .listenForWhisper("typing", (user) => {
        this.activeUser = user;
        if (this.typingTimer) {
          clearTimeout(this.typingTimer);
        }
        this.typingTimer = setTimeout(() => {
          this.activeUser = false;
        }, 3000);
      });*/
  },
  methods: {
    fetchMessages() {
      /*axios.get("messages").then((response) => {
        this.messages = response.data;
      });*/
    },
    sendMessage() {
      /*this.messages.push({
        user: this.user,
        message: this.newMessage,
      });
      axios.post("messages", { message: this.newMessage });
      this.newMessage = "";*/
    },
    sendTypingEvent() {
      /*Echo.join("chat").whisper("typing", this.user);*/
    },
  },
};
</script>
