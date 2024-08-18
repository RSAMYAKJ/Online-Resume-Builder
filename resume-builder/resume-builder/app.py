from flask import Flask, request, jsonify
import spacy

app = Flask(__name__)
nlp = spacy.load("en_core_web_sm")

def extract_keywords(text):
    doc = nlp(text)
    keywords = [chunk.text for chunk in doc.noun_chunks]
    return keywords

@app.route('/extract_keywords', methods=['POST'])
def get_keywords():
    data = request.json
    text = data['text']
    keywords = extract_keywords(text)
    return jsonify({"keywords": keywords})

if __name__ == "__main__":
    app.run(debug=True)
