define({ "api": [
  {
    "type": "get",
    "url": "/v3.1/ues/:sn/rt-info",
    "title": "获取设备上报实时信息",
    "version": "1.0.0",
    "name": "GetUeRealTimeInfo",
    "group": "UE",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>用户授权token</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "firm",
            "description": "<p>厂商编码</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmNlIjoid2ViIiwib3BlbkFJZCI6MTM2NywiY3JlYXRlZCI6MTUzMzg3OTM2ODA0Nywicm9sZXMiOiJVU0VSIiwiZXhwIjoxNTM0NDg0MTY4fQ.Gl5L-NpuwhjuPXFuhPax8ak5c64skjDTCBC64N_QdKQ2VT-zZeceuzXB9TqaYJuhkwNYEhrV3pUx1zhMWG7Org\",\n  \"firm\": \"cnE=\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/IndexController.php",
    "groupTitle": "UE"
  }
] });
