---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_5866d6a2fd90afb0501d518667addfe0 -->
## api/index
> Example request:

```bash
curl -X GET -G "http://localhost/api/index" 
```

```javascript
const url = new URL("http://localhost/api/index");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "a": 1,
    "b": 2
}
```

### HTTP Request
`GET api/index`

`POST api/index`

`PUT api/index`

`PATCH api/index`

`DELETE api/index`

`OPTIONS api/index`


<!-- END_5866d6a2fd90afb0501d518667addfe0 -->

<!-- START_1eedd8a5ebe92a99592df4a94c51f78f -->
## API首页
欢迎来到Laravel学院，Laravel学院致力于提供优质Laravel中文学习资源

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/index" 
```

```javascript
const url = new URL("http://localhost/api/v1/index");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET api/v1/index`


<!-- END_1eedd8a5ebe92a99592df4a94c51f78f -->


