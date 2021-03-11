<template>
  <div class="tabs-container">
    <div class="chat-tab">
      <div class="chat-header">
        <a href="#" class="user-avatar user-avatar--main"></a>
        <a href="#" class="user-name" title="Darrel Ignacio Masis">
          Darrel Ignacio Masis
        </a>
        <span class="user-state"> Activo(a) ahora </span>
        <div class="chat-options options-header">
          <i class="icon" title="Hacer una video llamada"></i>
          <i class="icon" title="hacer una llamada de voz"></i>
          <i class="icon" title="Configuración"></i>
          <i class="icon close" title="Cerrar chat"></i>
        </div>
      </div>
      <div class="chat-body">
        <div class="chat-container" id="conversation">
          <div class="chat">
            <div class="user-avatar"></div>
            <span class="chat-text"
              >Lorem ipsum dolor Lorem ipsum dolor sit, amet consectetur
              adipisicing elit.
            </span>
          </div>
          <div class="chat chat-user">
            <span class="chat-text">Lorem :).</span>
          </div>
          <div class="chat">
            <div class="user-avatar"></div>
            <span class="chat-text">Lorem ipsum dolor</span>
          </div>
          <div class="chat chat-user">
            <span class="chat-text"
              >Lorem ipsum dolor sit amet consectetur adipisicing elit.</span
            >
          </div>

          <div class="chat chat-user">
            <span class="chat-text">Lorem ipsum</span>
          </div>
        </div>
      </div>
      <div class="chat-footer">
        <form class="message-form">
          <textarea
            class="message"
            name="message"
            id="message"
            rows="1"
            placeholder="Escribe un mensaje..."
          ></textarea>
        </form>
        <div class="chat-options options-footer">
          <i class="icon image"></i>
          <i class="icon sticker"></i>
          <i class="icon gif"></i>
          <i class="icon emoji"></i>
          <i class="icon game"></i>
          <i class="icon clip"></i>
          <i class="icon camera"></i>
          <i class="icon calendar"></i>
          <i class="icon like"></i>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Tab",
  methods: {
    addOrder(e) {},
    deleteOrder(e) {},
  },
};
</script>
<style>
.tabs-container {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 20%;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.chat-tab {
  width: 17.75rem;
  margin: 0 0.5rem;
  box-shadow: 0 1px 4px rgba(#000, 0.3);
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
}
.chat-tab .close {
  width: auto;
}

.chat-header,
.chat-body,
.chat-footer {
  background-color: #fff;
}

.chat-tab,
.chat-header {
  border-top-left-radius: 0.5rem;
  border-top-right-radius: 0.5rem;
}

.chat-header {
  display: grid;
  grid-template-columns: auto 120px 1fr;
  grid-template-rows: repeat(2, auto);
  grid-column-gap: 0.65rem;
  justify-content: left;
  align-items: center;
  box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.1);
  padding: 0.5rem;
  cursor: pointer;
  z-index: 2;
}
.chat-header .chat-tab.close {
  grid-template-rows: 1fr;
}

.user-avatar {
  width: 1.75rem;
  height: 1.75rem;
  grid-row: span 2;
  position: relative;
  border-radius: 50%;
  background-image: url(https://raw.githubusercontent.com/darrelmasis/fb-chat-tab/master/img/avatar.png);
}
.user-avatar .--main:after {
  content: "";
  width: 0.6rem;
  height: 0.6rem;
  background-color: #f00;
  border: 2px solid #fff;
  position: absolute;
  bottom: 0;
  right: 0;
  border-radius: 50%;
}
.user-name {
  grid-column: 2;
  grid-row: 1;
  color: #000;
  font-size: 14px;
  font-weight: 600;

  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.user-name :hover {
  color: inherit;
}
.user-state {
  grid-column: 2;
  grid-row: 2;
  font-size: 12px;
  font-weight: 500;
  color: #f0440043;
  cursor: default;
}
.user-state .chat-tab.close {
  display: none;
}
.chat-options {
  display: flex;
  grid-row: span 2;
  justify-content: space-between;
  align-items: center;
}

.options-header .chat-tab.close {
  justify-self: right;
}
.icon {
  width: 1rem;
  height: 1rem;
  background-color: #fff0f0;
  cursor: pointer;
  background: url("https://raw.githubusercontent.com/darrelmasis/fb-chat-tab/master/img/dAgGoyMhmXa.png");
}

.chat-body {
  position: relative;
}
.chat-body .chat-tab.close {
  display: none;
}
.chat-container {
  height: 230px;
  overflow-y: auto;
  padding: 0.5rem;
  font-size: 0.8125em;
  margin-right: 0.5rem;
}

.chat-footer {
  padding: 0.5rem;
  border-top: 1px solid 12px;
}
.chat-footer .chat-tab.close {
  display: none;
}
.message-form {
  padding-top: 0.375rem;
  padding-bottom: 0.375rem;
}

.message {
  width: 100%;
  resize: none;
  border: none;
  font-family: inherit;
  line-height: 1.5;
  max-height: 6.25rem;
  outline: 0;
  overflow-y: auto;
  padding: 0 0.5rem 0 0;
  background-color: transparent;
}

.chat {
  display: flex;
  align-items: center;
  margin: 0.5rem 0;
}
.chat .user-avatar {
  margin-right: 0.5rem;
}
.chat-text {
  background-color: #fff;
  padding: 0.5rem;
  border-radius: 1rem;
  max-width: 70%;
}
</style>