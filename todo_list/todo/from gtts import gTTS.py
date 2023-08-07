from gtts import gTTS
import os

# Website explanation text
website_text = "Welcome to our website. We provide top-notch services to our customers and have a user-friendly interface."

# Create a text-to-speech object
tts = gTTS(text=website_text, lang='en')

# Save the audio file
audio_file_path = "website_explanation.mp3"
tts.save(audio_file_path)

# Play the audio (optional)
os.system("start " + audio_file_path)
