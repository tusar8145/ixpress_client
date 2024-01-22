
import { PrismaClient } from '@prisma/client';
import express from 'express';
import jwt from 'jsonwebtoken';
import md5 from 'md5';
import cors from "cors";

//
import fs from 'node:fs';
import path  from 'path';
import { fileURLToPath } from 'url';
import { IncomingForm } from 'formidable';
import { Verify } from 'node:crypto';


 import  multer   from 'multer';

 const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, 'uploads/')
  },
  filename: function (req, file, cb) {
    const uniqueSuffix = file.originalname
    cb(null, uniqueSuffix)
  }
})


 const upload = multer({ storage: storage })


const prisma = new PrismaClient()
const app = express()

 const corsOptions = {
  origin: "*",
  credentials: true, //access-control-allow-credentials:true
  optionSuccessStatus: 200,
};

app.use(cors(corsOptions));


app.use(express.json({limit: '2500mb'}));
app.use(express.urlencoded({limit: '2500mb'}));

 
 //Finding the present working directory. We need this at while saving the file in server. 
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
 



const JWT_SECRET = 'jwt_secret_key';
const JWT_VALIDITY = '1 day';

const auth =(req, res, next)=>{
  try {
      let token=req.headers.accesstoken
      if(token){
          token=token.split(" ")[1];
          let user = jwt.verify(token,JWT_SECRET);
           //console.log(user)
          req.userId2=user.userId;  //
          req.branch=user.branch;
          //res.status(401).json({message:user});

      }else{
          res.status(401).json({message:"Unauthorized User"});

      }
      next();
  } catch (error) {
      res.status(401).json({message:"Unauthorized User"});
  }
}

const marchant =async (req, res, next)=>{

  try {
    var api_key=req.body.api_key 

    if(api_key){
      const yyy = await prisma.tbl_users.findMany(
        {
          where: {  
            AND: [
                {
                    employee_id: api_key,
                }
              ]
            },
        }
        )

      req.body.user_id=yyy[0].userID
      next();
    }else{
      res.status(401).json({message:"Unauthorized User"});
    } 
} catch (error) {
  res.status(401).json({message:"Unauthorized User"});
} 

}



app.post('/api',auth, async (req, res) => {
  res
  .status(200)
  .json({
    success: req.userId2,
  }); 
  
})

app.get('/test', async (req, res) => {
  res
  .status(200)
  .json({
    success:456,
  }); 
  
})


app.get("/api/image/:image", async(req, res) => {
  let image = req.params.image
  res.sendFile(path.join(__dirname, "./uploads/"+image+".jpg"));
});


 
app.post('/api/podapp/:counts', upload.single('uploaded_file'), function (req, res) {
  console.log('888888888888888888')
  console.log(req.file, req.body)
  res.status(200).json({});
}); 




app.post('/api/pod/:counts', async (req, res, next) => {
  console.log('99999999999999999999999999999999999999999999999999999999999999',req.params.counts,)
  const uploadDir = path.join(__dirname + '/uploads'); 
  if (!fs.existsSync(uploadDir)) fs.mkdirSync(uploadDir, '0777', true);
  const customOptions = { uploadDir: uploadDir, keepExtensions: true, allowEmptyFiles: false, maxFileSize: 5 * 1024 * 1024 * 1024, multiples: true };
  const form = new IncomingForm(customOptions);
  console.log(form)
  let file_count = req.params.counts
 
  form.parse(req, (err, fields, files) => {
    if (err) {
      next(err);
      return;
    }
    for (let x = 0; x < file_count; x++) {
      try {

        const file = files['file-' + x.toString()]
        let str = file.toString()
        const myArray = str.split(",");


        const ssmyArray1 = myArray[1].split(":");
        var trimmedStr = ssmyArray1[1].trimStart();
        trimmedStr = trimmedStr.trimEnd();
        const newFilepath = `${uploadDir}/${trimmedStr}`;



        const ssmyArray1_1 = myArray[0].split(":");
        var trimmedStr_1 = ssmyArray1_1[1].trimStart();
        trimmedStr_1 = trimmedStr_1.trimEnd();
        const newFilepath_1 = `${uploadDir}/${trimmedStr_1}`;


        //console.log(newFilepath_1, newFilepath, 'newFilepath')
        fs.rename(newFilepath_1, newFilepath, err => err);

      } catch (error) {
        console.log(error, 'error')
      }


      //console.log(file.name,'file-'+x.toString())
    }
    res.status(200).json({});
  });
})

app.post('/api/user/change_branch',auth, async (req, res, next) => {
try{
            const selected_branch = req.body.selected_branch;
            const this_user = req.body.this_user;
console.log({
  where: {
    userID: this_user,
  },
  data: {
    branch_id: selected_branch,
  },
},'9999999999999999999999999')
            const updateUser = await prisma.tbl_users.update({
              where: {
                userID: this_user,
              },
              data: {
                branch_id: selected_branch,
              },
            })

            res
            .status(200)
            .json({
              success: true,
              result:updateUser,
              selected_branch:selected_branch,
              this_user:this_user,
            }); 

     
}catch(error){
  next(error)
}
})


app.post('/api/user/login',async (req, res, next) => {
  try{

            const email = req.body.email;
            const password = req.body.password;
            var tbl_users_userType =null
if(!email.length>2 && !password.length>2){
				res
               .status(401)
               .json({
                 success: false,
                 message:"unauthorize"
               });
}

              var users=null;
              users = await prisma.tbl_users.findMany({
              where: {
                        userEmail: email, 
                        userPass: md5(password)
              },
               })  


              /* res
               .status(200)
               .json({
                 success: true,
                 email:email,
                 password:password,
                 getUser:users
               }); */
 
                

               var branch=users[0]?.branch_id
               var unique=[]
               var first_branch=[]
               if(branch!=''){ 
                        var nameArr = branch.split(',');
                        first_branch=nameArr[0]
                        var nums = nameArr.map(function(str) {
                          // using map() to convert array of strings to numbers
              
                          return parseInt(str); });
                          
                          unique = nums.reduce(function (acc, curr) {
                            if (!acc.includes(curr))
                                acc.push(curr);
                            return acc;
                        }, []);
                }


              var userType=parseInt(users[0].userType)
              var is_all_branch=0;
              var is_delivery_boy=0;
              var is_marchant=0;
              var is_pickup=0;
              var is_scan_pod=0;
              var is_update_status=0;
              var is_quick_status=0;
              var is_setup_conf=0;
              var is_all_report=0;
			  
			  var is_all_report_data=0;
			  var is_all_report_deli=0;
			  var is_all_report_ship=0;
			  
              var user_type='';
              var is_billing=0;
              var is_issue=0;
              var commission=0;

              if(userType!=''){ 
                   tbl_users_userType = await prisma.tbl_users_userType.findMany({
                    where: {
                      AND: [
                              {userType_id: userType}, 
                          ] 
                    },})  

                    if(tbl_users_userType[0].is_all_branch=='1'){ is_all_branch=1; }
                    is_marchant=parseInt(tbl_users_userType[0].is_marchant)
                   /* is_delivery_boy=parseInt(tbl_users_userType[0].is_delivery_boy)
                    is_marchant=parseInt(tbl_users_userType[0].is_marchant)
                    is_pickup=parseInt(tbl_users_userType[0].is_pickup)
                    is_all_report=parseInt(tbl_users_userType[0].is_all_report)
                    is_scan_pod=parseInt(tbl_users_userType[0].is_scan_pod)
                    is_update_status=parseInt(tbl_users_userType[0].is_update_status)
                    is_quick_status=parseInt(tbl_users_userType[0].is_quick_status)
                    is_billing=parseInt(tbl_users_userType[0].is_billing)
                    is_issue=parseInt(tbl_users_userType[0].is_issue)
                    is_setup_conf=parseInt(tbl_users_userType[0].is_setup_conf)*/
                    user_type=tbl_users_userType[0].userType
                }      
 
 console.log(is_marchant,is_all_branch,'is_marchant',unique)
 
 if(is_marchant==1){
	 //must have a client branch assigned
	 var t_user_ids=users[0].userID
	        var active_branches = await prisma.services_clients_branch.count({
              where: {
                        userID: users[0].userID, 
              },
            })   
			 
			if(!active_branches>0){
							res
						   .status(200)
						   .json({
							 success: true,
							 message:"No Clients Assigned",
						   });	 
			}			 

  }
 

              const branchs = await prisma.branch.findMany({
              //...(pickup_date_3 ? { pickup_date_3: pickup_date_3 } : {}),
              where: {
                AND: [
                    {
                      ...(is_all_branch==0 ? {  branch_id: { in:unique }, } : {}),
                     
                    },
                  ],
                },
                select: {
                  branch_id: true,
                  branch: true,
                },
            })
                
 
             


 
            if(Object.keys(users).length >0){
                const accessToken = jwt.sign({ userId:users[0].userID,email:email,password:password, branch:branch }, JWT_SECRET, { expiresIn: JWT_VALIDITY,  });
 
                
                const user = await prisma.tbl_users_token.create({
                  data: {
                    creator: users[0].userID,
                    token: accessToken.slice(-10),
                  },
                })

 
 
 
                  res 
                  .status(200)
                  .json({
                    success: true,
                    getUser:users,
                    accessToken:accessToken,
                    userId1:users[0].userID,
                    branch:branchs,
                    first_branch:first_branch,
                    tbl_users_userType:tbl_users_userType,
                    user_type:user_type,
                  }); 

            }else{
                   res 
                  .status(404)
                  .json({
                    success: false,
                    getUser:users,
                  });
            }
 
     
      
  }catch(error){
     next(error)
  }
})
  





app.post('/api/get_general_customer',auth, async (req, res) => {

  try{




    const general_customer = await prisma.pickup.findMany(
      {
        take: 1,
        orderBy: {
          
            id: 'desc',
          
        },
        where: {
          OR: [
            {
              sender_phone_5:req.body.phone,
            },
            {  recipient_phone_20:req.body.phone, },
          ]
         
        },
      }
    )
    
    res.json({
      success: true,
      general_customer:general_customer,
      message: "Operation Successful", 
    })
    
  
  }catch(error){
     next(error)
  }
})





app.post('/api/testsum',auth, async (req, res) => {
  
  var current_branch_id=req.body.current_branch_id
  const services_id_1=parseInt(req.body.choice)
	    var created_branch_id=req.body.created_branch_id

  var range_start=req.body.range_start
  var range_end=req.body.range_end

  let selected_delivery_status=req.body.selected_delivery_status
//console.log(selected_delivery_status)

  const sender_client_id_7=req.body.sender_client_id_7
  const i_product_type_id=req.body.i_product_type_id
  const i_priority_id_3=parseInt(req.body.i_priority_id_3)

  
  let user_id=req.body.user_id  

  const is_delivery_boy=req.body.is_delivery_boy 

  var delivery_boy_id=null
  
  if(is_delivery_boy==1){
  delivery_boy_id=parseInt(req.body.delivery_boy_id)
   current_branch_id=null
   user_id=null
  }

//if(created_branch_id>0){ current_branch_id=null }

  var unique=[]
  if(user_id>0){//so marchant
    const services_clients_branch = await prisma.services_clients_branch.findMany(
        {
          where: {  
            AND: [
                {
                  ...(user_id > 0 ? { userID: user_id } : {}),
                }
              ]
            },
        }
        )


        if(user_id > 0){
          for(let i = 0; i < services_clients_branch.length; i++) {
            let obj = services_clients_branch[i];
            unique.push(obj.services_clients_id)
          }
        }
  } 

 

const groupUsers = await prisma.pickup.groupBy({
  by: ['sender_client_id_7'],
  where: {        ...(created_branch_id ? { created_branch_id: created_branch_id } : {}),   ...(i_priority_id_3 ? { i_priority_id_3: i_priority_id_3 } : {}),   ...(selected_delivery_status ? { i_delivery_status_id_18: selected_delivery_status } : {}),      pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},      ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),      ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),      ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),  ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}), },
  _sum: { 
    amount_from_wallet: true,
    amount_to_wallet: true,
    delivery_cost_amount: true,
    cod_cost_amount: true,
    collection_amount: true,
    return_cost_amount: true,
  },
})

 

res.json({
  groupUsers:groupUsers, 
}); 

})






app.post('/api/balance_counts', async (req, res) => {
  var current_branch_id=req.body.current_branch_id
  const services_id_1=req.body.services_id_1
  const sender_client_id_7=req.body.sender_client_id_7

  const user_id=req.body.user_id 

  const is_delivery_boy=req.body.is_delivery_boy 

  var delivery_boy_id=null
  
  if(is_delivery_boy==1){
  delivery_boy_id=parseInt(req.body.delivery_boy_id)
   current_branch_id=null
   user_id=null
  }


  var unique=[]
  if(user_id>0){//so marchant
    const services_clients_branch = await prisma.services_clients_branch.findMany(
        {
          where: {  
            AND: [
                {
                  ...(user_id > 0 ? { userID: user_id } : {}),
                }
              ]
            },
        }
        )


        if(user_id > 0){
          for(let i = 0; i < services_clients_branch.length; i++) {
            let obj = services_clients_branch[i];
            unique.push(obj.services_clients_id)
          }
        }
  } 
 // unique.push(4)
 
  var result 
  var kk=unique.toString()
  if(user_id>0){ //marchant
      if(unique.length>0){
        const email = '1,5'
          result = await prisma.$queryRaw`SELECT sum(amount_from_wallet) as amount_from_wallet,  sum(amount_to_wallet) as amount_to_wallet,     sum(delivery_cost_amount) as delivery_cost_amount, sum(return_cost_amount) as return_cost_amount,sum(cod_cost_amount) as cod_cost_amount,sum(collection_amount) as collection_amount FROM  pickup     where sender_client_id_7 in (${email})`
      }    
  }else{  
          result = await prisma.$queryRaw`SELECT sum(amount_from_wallet) as amount_from_wallet,  sum(amount_to_wallet) as amount_to_wallet,     sum(delivery_cost_amount) as delivery_cost_amount, sum(return_cost_amount) as return_cost_amount,sum(cod_cost_amount) as cod_cost_amount,sum(collection_amount) as collection_amount FROM  pickup`
  }

  
 

  res.json({
    as:unique,
    kk:kk,
    result:result,
    unique:unique, 
    user_id:user_id,
  
  });


})



app.get('/api/collection-summary-v2',marchant, async (req, res) => {
  var current_branch_id=req.body.current_branch_id
  const services_id_1=parseInt(req.body.choice)

  var range_start=req.body.range_start
  var range_end=req.body.range_end

  let selected_delivery_status=req.body.selected_delivery_status
//console.log(selected_delivery_status)

  const sender_client_id_7=req.body.sender_client_id_7
  const i_product_type_id=req.body.i_product_type_id

  let user_id=req.body.user_id  

  const is_delivery_boy=req.body.is_delivery_boy 

  var delivery_boy_id=null
  
  if(is_delivery_boy==1){
  delivery_boy_id=parseInt(req.body.delivery_boy_id)
   current_branch_id=null
   user_id=null
  }


  var unique=[]
  if(user_id>0){//so marchant
    const services_clients_branch = await prisma.services_clients_branch.findMany(
        {
          where: {  
            AND: [
                {
                  ...(user_id > 0 ? { userID: user_id } : {}),
                }
              ]
            },
        }
        )


        if(user_id > 0){
          for(let i = 0; i < services_clients_branch.length; i++) {
            let obj = services_clients_branch[i];
            unique.push(obj.services_clients_id)
          }
        }
  } 

 

const groupUsers = await prisma.pickup.groupBy({
  by: ['sender_client_id_7'],
  where: {     ...(selected_delivery_status ? { i_delivery_status_id_18: selected_delivery_status } : {}),      pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},      ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),      ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),      ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),  ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}), },
  _sum: { 
    amount_from_wallet: true,
    amount_to_wallet: true,
    delivery_cost_amount: true,
    cod_cost_amount: true,
    collection_amount: true,
    return_cost_amount: true,
  },
})

 

res.json(groupUsers[0]._sum); 
})

















 
app.post('/api/pickup_download',auth, async (req, res) => {
  var skip=req.body.skip
  var take=req.body.get_itms


   var current_branch_id=req.body.current_branch_id
   
   var created_branch_id=req.body.created_branch_id

  const sender_client_id_7=req.body.sender_client_id_7
  const i_product_type_id=req.body.i_product_type_id
  let i_delivery_status_id_18=req.body.i_delivery_status_id_18 
  const i_priority_id_3=parseInt(req.body.i_priority_id_3)


if(i_delivery_status_id_18==99){
  i_delivery_status_id_18=null
} 

var user_id=req.body.user_id 

  const is_delivery_boy=req.body.is_delivery_boy 

  var delivery_boy_id=null

  const services_id_1=parseInt(req.body.choice)
  let this_date=req.body.this_date
  const myArray = this_date?.split(",");

  var range_start=null
  var range_end=null
  if(myArray?.length>0){
      range_start=myArray[0]
      range_end=myArray[1]
  }



  //console.log(range_start,range_end,'range_end')

  if(is_delivery_boy==1){
  delivery_boy_id=parseInt(req.body.delivery_boy_id)
   current_branch_id=null
   user_id=null
  }
//if(created_branch_id>0){ current_branch_id=null }


  var unique=[]
  if(user_id>0){//so marchant
    const services_clients_branch = await prisma.services_clients_branch.findMany(
        {
          where: {  
            AND: [
                {
                  ...(user_id > 0 ? { userID: user_id } : {}),
                }
              ]
            },
        }
        )


        if(user_id > 0){
          for(let i = 0; i < services_clients_branch.length; i++) {
            let obj = services_clients_branch[i];
            unique.push(obj.services_clients_id)
          }
        }
  }


   // console.log("pickup_date_3",req.body)
   

    const processing = await prisma.pickup.findMany({ 
      skip: skip ,
      take: take ,
      where:{      
	        ...(created_branch_id ? { created_branch_id: created_branch_id } : {}), 

        ...(i_priority_id_3 ? { i_priority_id_3: i_priority_id_3 } : {}), 
        pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  
        ...(range_start ? { gte: range_start } : {}),},  
        ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),      
        ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),      
        ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  
        ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  
        ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    
        ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),
        ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),
        ...(i_delivery_status_id_18 ? { i_delivery_status_id_18: i_delivery_status_id_18 } : {}) 
      
      },     
      include: {
        delivery_boy_id_: {
          select:{
            userName:true,
            userID:true,
            employee_id : true,
            commission_rate : true,
          }
        }, 
        i_relation: {
          select:{
            i_relation:true,
          }
        }, 
        i_return_cause: {
          select:{
            i_return_cause:true,
          }
        },
        services: {
          select:{
            services:true,
          }
        }, 
        i_product_type: {
          select:{
            i_product_type:true,
          }
        }, 
        i_priority: {
          select:{
            i_priority:true,
          }
        }, 
        i_payment_type: {
          select:{
            i_payment_type:true,
          }
        }, 
        i_packaging_type: {
          select:{
            i_packaging_type:true,
          }
        }, 
        i_shipment_method: {
          select:{
            i_shipment_method:true,
          }
        }, 
        i_delivery_status: {
          select:{
            i_delivery_status:true,
          }
        },
        i_tracking_status: {
          select:{
            i_tracking_status:true,
          }
        },
        current_branch: {
          select:{
            branch:true,
          }
        },
        created_branch_: {
          select:{
            branch:true,
          }
        },
        creator1_: {
          select:{
            userName:true,
          }
        }
      },
    
      
      })

     // console.log("stock_counts_download_end") 
    
  res.json({
    result:processing, 
  
  });
})


app.post('/api/stock_counts',auth, async (req, res) => {


  var current_branch_id=req.body.current_branch_id
	    var created_branch_id=req.body.created_branch_id





  const sender_client_id_7=req.body.sender_client_id_7
  const i_product_type_id=req.body.i_product_type_id
  const i_priority_id_3=parseInt(req.body.i_priority_id_3)
  
console.log(i_priority_id_3,'i_priority_id_3')

  var user_id=req.body.user_id 

  const is_delivery_boy=req.body.is_delivery_boy 

  var delivery_boy_id=null

  const services_id_1=parseInt(req.body.choice)
   var range_start=req.body.range_start
   var range_end=req.body.range_end


   if(range_start==null || range_end==null){
        let this_date=req.body.this_date
        const myArray = this_date?.split(",");

      
        if(myArray?.length>0){
            range_start=myArray[0] 
            range_end=myArray[1]
        } 
   }





  if(is_delivery_boy==1){
  delivery_boy_id=parseInt(req.body.delivery_boy_id)
   current_branch_id=null
   user_id=null
  }
//if(created_branch_id>0){ current_branch_id=null }


  var unique=[]
  if(user_id>0){//so marchant
    const services_clients_branch = await prisma.services_clients_branch.findMany(
        {
          where: {  
            AND: [
                {
                  ...(user_id > 0 ? { userID: user_id } : {}),
                }
              ]
            },
        }
        )


        if(user_id > 0){
          for(let i = 0; i < services_clients_branch.length; i++) {
            let obj = services_clients_branch[i];
            unique.push(obj.services_clients_id)
          }
        }
  }

 /*res.json({
    user_id:user_id,
    current_branch_id:current_branch_id,
    unique:unique,
  });*/




 
 
   

    const processing = await prisma.pickup.count({ where:{ ...(created_branch_id ? { created_branch_id: created_branch_id } : {}),    ...(i_priority_id_3 ? { i_priority_id_3: i_priority_id_3 } : {}),   pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),      ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),      ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:3 },     })
    const shipped = await prisma.pickup.count({ where: { ...(created_branch_id ? { created_branch_id: created_branch_id } : {}),   ...(i_priority_id_3 ? { i_priority_id_3: i_priority_id_3 } : {}),   pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),     ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),     ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:4 }, })
    const in_transit = await prisma.pickup.count({ where: { ...(created_branch_id ? { created_branch_id: created_branch_id } : {}),   ...(i_priority_id_3 ? { i_priority_id_3: i_priority_id_3 } : {}),   pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),      ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:5 }, })
    const hold = await prisma.pickup.count({ where: { ...(created_branch_id ? { created_branch_id: created_branch_id } : {}),    ...(i_priority_id_3 ? { i_priority_id_3: i_priority_id_3 } : {}),   pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),     ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:9 }, })
    const return_process = await prisma.pickup.count({ where: { ...(created_branch_id ? { created_branch_id: created_branch_id } : {}),    ...(i_priority_id_3 ? { i_priority_id_3: i_priority_id_3 } : {}),  pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),     ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),      ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:7 }, })
    const booking = await prisma.pickup.count({ where: { ...(created_branch_id ? { created_branch_id: created_branch_id } : {}),   ...(i_priority_id_3 ? { i_priority_id_3: i_priority_id_3 } : {}),   pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),   ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),       ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:2 }, })
    const out_for_deli = await prisma.pickup.count({ where: { ...(created_branch_id ? { created_branch_id: created_branch_id } : {}),    ...(i_priority_id_3 ? { i_priority_id_3: i_priority_id_3 } : {}),  pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),       ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:12 }, })
    const exception = await prisma.pickup.count({ where: { ...(created_branch_id ? { created_branch_id: created_branch_id } : {}),  ...(i_priority_id_3 ? { i_priority_id_3: i_priority_id_3 } : {}),    pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),       ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:10 }, })
    const delivered = await prisma.pickup.count({ where: { ...(created_branch_id ? { created_branch_id: created_branch_id } : {}),   ...(i_priority_id_3 ? { i_priority_id_3: i_priority_id_3 } : {}),    pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),}, ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),       ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:6 }, })
    const return_received = await prisma.pickup.count({ where: { ...(created_branch_id ? { created_branch_id: created_branch_id } : {}),   ...(i_priority_id_3 ? { i_priority_id_3: i_priority_id_3 } : {}),   pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),       ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:8 }, })
   
  
 
  
  res.json({
    processing:processing,
    shipped:shipped,
    in_transit:in_transit,
    hold:hold,
    return_process:return_process,
    booking:booking,
    out_for_deli:out_for_deli,
    exception:exception,
    delivered:delivered,
    return_received:return_received,
 
  });


})
 
app.get('/api/status-summary-v2',marchant, async (req, res) => {


  var current_branch_id=req.body.current_branch_id

  const sender_client_id_7=req.body.sender_client_id_7
  const i_product_type_id=req.body.i_product_type_id

  var user_id=req.body.user_id 
 

  const is_delivery_boy=req.body.is_delivery_boy 

  var delivery_boy_id=null

  const services_id_1=parseInt(req.body.choice)
   var range_start=req.body.range_start
   var range_end=req.body.range_end


   if(range_start==null || range_end==null){
        let this_date=req.body.this_date
        const myArray = this_date?.split(",");

      
        if(myArray?.length>0){
            range_start=myArray[0] 
            range_end=myArray[1]
        } 
   }





  if(is_delivery_boy==1){
  delivery_boy_id=parseInt(req.body.delivery_boy_id)
   current_branch_id=null
   user_id=null
  }


  var unique=[]
  if(user_id>0){//so marchant
    const services_clients_branch = await prisma.services_clients_branch.findMany(
        {
          where: {  
            AND: [
                {
                  ...(user_id > 0 ? { userID: user_id } : {}),
                }
              ]
            },
        }
        )


        if(user_id > 0){
          for(let i = 0; i < services_clients_branch.length; i++) {
            let obj = services_clients_branch[i];
            unique.push(obj.services_clients_id)
          }
        }
  }
 
   

    const processing = await prisma.pickup.count({ where:{      pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),      ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),      ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:3 },     })
    const shipped = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),     ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),     ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:4 }, })
    const in_transit = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),      ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:5 }, })
    const hold = await prisma.pickup.count({ where: {      pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),     ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:9 }, })
    const return_process = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),     ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),      ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:7 }, })
    const booking = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),   ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),       ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:2 }, })
    const out_for_deli = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),       ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:12 }, })
    const exception = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),       ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:10 }, })
    const delivered = await prisma.pickup.count({ where: {      pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),}, ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),       ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:6 }, })
    const return_received = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),       ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),  ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:8 }, })
   
  
 
  
  res.json({
    booking:booking,
    processing:processing,
    shipped:shipped,
    in_transit:in_transit,
    hold:hold,
    return_process:return_process,
    out_for_deli:out_for_deli,
    exception:exception,
    delivered:delivered,
    return_received:return_received,
  });


})

app.post('/api/stock_counts_this',auth, async (req, res) => {


  var current_branch_id=req.body.current_branch_id

  const sender_client_id_7=req.body.sender_client_id_7
  const i_product_type_id=req.body.i_product_type_id

  

  var user_id=req.body.user_id 

  const is_delivery_boy=req.body.is_delivery_boy 

  var delivery_boy_id=null

  const services_id_1=parseInt(req.body.choice)
   var range_start=req.body.range_start
   var range_end=req.body.range_end


   if(range_start==null || range_end==null){
        let this_date=req.body.this_date
        const myArray = this_date?.split(",");

      
        if(myArray?.length>0){
            range_start=myArray[0] 
            range_end=myArray[1]
        } 
   }





  if(is_delivery_boy==1){
  delivery_boy_id=parseInt(req.body.delivery_boy_id)
   current_branch_id=null
   user_id=null
  }


  var unique=[]
  if(user_id>0){//so marchant
    const services_clients_branch = await prisma.services_clients_branch.findMany(
        {
          where: {  
            AND: [
                {
                  ...(user_id > 0 ? { userID: user_id } : {}),
                }
              ]
            },
        }
        )


        if(user_id > 0){
          for(let i = 0; i < services_clients_branch.length; i++) {
            let obj = services_clients_branch[i];
            unique.push(obj.services_clients_id)
          }
        }
  }

 /*res.json({
    user_id:user_id,
    current_branch_id:current_branch_id,
    unique:unique,
  });*/




 
 
   

  const processing = await prisma.pickup.count({ where:{      pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),            ...(current_branch_id ? { created_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:3 },     })
  const shipped = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),          ...(current_branch_id ? { created_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:4 }, })
  const in_transit = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),          ...(current_branch_id ? { created_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:5 }, })
  const hold = await prisma.pickup.count({ where: {      pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),         ...(current_branch_id ? { created_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:9 }, })
  const return_process = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),           ...(current_branch_id ? { created_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:7 }, })
  const booking = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),          ...(current_branch_id ? { created_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:2 }, })
  const out_for_deli = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),           ...(current_branch_id ? { created_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:12 }, })
  const exception = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),           ...(current_branch_id ? { created_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:10 }, })
  const delivered = await prisma.pickup.count({ where: {      pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),}, ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),           ...(current_branch_id ? { created_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:6 }, })
  const return_received = await prisma.pickup.count({ where: {     pickup_date_3: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),           ...(current_branch_id ? { created_branch_id: current_branch_id } : {}),  ...(services_id_1 ? { services_id_1: services_id_1 } : {}),    ...(i_product_type_id ? { i_product_type_id_2: i_product_type_id } : {}),i_delivery_status_id_18:8 }, })
 
  
 
  
  res.json({
    processing:processing,
    shipped:shipped,
    in_transit:in_transit,
    hold:hold,
    return_process:return_process,
    booking:booking,
    out_for_deli:out_for_deli,
    exception:exception,
    delivered:delivered,
    return_received:return_received,
 
  });


})


 
app.post('/api/setup_config_basic',auth, async (req, res, next) => {

  var id=req.body.id
  const is_all_branch=req.body.is_all_branch
  const is_marchant=req.body.is_marchant

  const allow_clients=[]
  const allow_branchs=[]

  if(is_all_branch==0 && is_marchant==1){
   
  }else{
       id=0
  }

// ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),
  try{

     
    const services_clients_branch = await prisma.services_clients_branch.findMany(
            {
        where: {  
          AND: [
              {
                ...(id > 0 ? { userID: id } : {}),
              }
            ]
          },
      }
    )

    var unique=[]
    if(id > 0){
        for(let i = 0; i < services_clients_branch.length; i++) {
          let obj = services_clients_branch[i];
          unique.push(obj.services_clients_id)
        }
    }


    const services_clients = await prisma.services_clients.findMany(
      {
        where: {  
          AND: [
              {
                ...(unique.length>0 ? {  services_clients_id: { in:unique }, } : {}),
              }
            ]
          },
      }
    )

    //


    const i_product_type = await prisma.i_product_type.findMany()
 
 

    res.json({
      success: true,
      i_product_type: i_product_type,
      services_clients:services_clients,
      services_clients_branch:services_clients_branch,
       message: "Operation Successful", 
    }) 
    
  
  }catch(error){
     next(error)
  }
})


app.post('/api/setup_config',auth, async (req, res, next) => {

  var id=req.body.id
  const is_all_branch=req.body.is_all_branch
  const is_marchant=req.body.is_marchant

  const allow_clients=[]
  const allow_branchs=[]

  if(is_marchant==1){
   
  }else{
       id=0
  }

// ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),
  try{

     
    const services_clients_branch = await prisma.services_clients_branch.findMany(
            {
        where: {  
          AND: [
              {
                ...(id > 0 ? { userID: id } : {}),
              }
            ]
          },
      }
    )

    var unique=[]
    if(id > 0){
        for(let i = 0; i < services_clients_branch.length; i++) {
          let obj = services_clients_branch[i];
          unique.push(obj.services_clients_id)
        }
    }

console.log(unique,'uniquexx',id)

    const services_clients = await prisma.services_clients.findMany(
      {
        where: {  
          AND: [
              {
                ...(unique.length>0 ? {  services_clients_id: { in:unique }, } : {}),
              }
            ]
          },
      }
    )

    //


    const i_product_type = await prisma.i_product_type.findMany()
    const i_relation = await prisma.i_relation.findMany()
    const i_return_cause = await prisma.i_return_cause.findMany()
    const i_sms_template = await prisma.i_sms_template.findMany()
    const i_tracking_status = await prisma.i_tracking_status.findMany()
    const i_unit = await prisma.i_unit.findMany()
    const i_payment_type = await prisma.i_payment_type.findMany()
    const i_priority =   await prisma.i_priority.findMany()
    const services = await prisma.services.findMany()
    const i_shipment_method =   await prisma.i_shipment_method.findMany()
    const i_packaging_type =   await prisma.i_packaging_type.findMany()
    const i_delivery_status =   await prisma.i_delivery_status.findMany()
    const i_zone =   await prisma.zone.findMany()



    //



    const delivery_boy =   await prisma.tbl_users.findMany({
            where: {
               userType: 15,
        },
         select: 
          { userID:true,
            userName: true,
            employee_id : true,
          },
        
    }
    ) 

    const operator_users =   await prisma.tbl_users.findMany({
      where: {
       
          userType: {in: [1,5,10,20]}
        
         
  },
   select: 
    { userID:true,
      userName: true,
      employee_id : true,
    },
  
}
) 
//SenderRecipient.jsx
    const zone_countries =   await prisma.zone_countries.findMany()
    const zone_districts =   await prisma.zone_districts.findMany()
    const zone_divisions =   await prisma.zone_divisions.findMany()
    const zone_upazilas =   await prisma.zone_upazilas.findMany()
    const branch =   await prisma.branch.findMany()
    

   /* res.json({
      success: true, 
      is_all_branch:is_all_branch,
       is_marchant:is_marchant,
      services_clients_branch:services_clients_branch,
      services_clients:services_clients,
      message: "Operation Successful", 
    })*/

    res.json({
      success: true,
      delivery_boy:delivery_boy,
      operator_users:operator_users,
      i_product_type: i_product_type,
      i_relation: i_relation,
      i_return_cause: i_return_cause,
      i_sms_template: i_sms_template,
      i_tracking_status: i_tracking_status,
      i_unit: i_unit,
      services_clients:services_clients,
      services_clients_branch:services_clients_branch,
      i_payment_type:i_payment_type,
      i_priority:i_priority,
      services:services,
      i_shipment_method:i_shipment_method,
      i_packaging_type:i_packaging_type,
      i_delivery_status:i_delivery_status,
      i_zone:i_zone,
      zone_countries:zone_countries,
      zone_districts:zone_districts,
      zone_divisions:zone_divisions,
      zone_upazilas:zone_upazilas,
      branch:branch,
      message: "Operation Successful", 
    }) 
    
  
  }catch(error){
     next(error)
  }
})


app.post('/api/create_pickup_tracking',auth, async (req, res, next) => {
  try{

    //insert
     const data = req.body
    // console.log(data,'data')
      const createMany = await prisma.pickup_tracking.createMany({
        data: req.body ,
        skipDuplicates: true, 
      })
 
 
      //update 
      var count ='';
      const get_=req.body;
      var pickup_ids=[]
      var act
      for (var i = 0; i < get_.length; i++){
          let date_
		  let pickup_date=null
           var obj = get_[i];
           count =obj.i_delivery_status_id_18;
           act=obj.action_type
           if(obj.action_type=='update_to_shipped'){
            pickup_ids.push(obj.pickup_id)
           }  


           var delivery_boy_area=null
           if(obj.action_type=='send_to_deliveryman'){
              delivery_boy_area=obj.pickup_reference_id
              date_ = obj.date.substring(0, 10);
           }


			if(obj.i_delivery_status_id_18==3){
				let vdate_ = obj.date.substring(0, 10);
				pickup_date=vdate_
			}
		   
      // if(pickup_ids.length>0){
       /* const updateUser2 = await prisma.pickup_tracking.update({
          where: {
           pickup_id: obj.pickup_id,
          },
          data: {
            note:'Received'
          },
        })*/
      //}*

      
            
          var time = obj.time
          let date2_ = obj.date;


         if(time){
            const myArray = time.split(":");
           
         var hours = myArray[0];
         var minutes = myArray[1];
         var ampm = hours >= 12 ? 'pm' : 'am';
         hours = hours % 12;
         hours = hours ? hours : 12; // the hour '0' should be '12'
         minutes = minutes < 10 ? '0'+minutes : minutes;
         var strTime = hours + ':' + minutes + ' ' + ampm;
         time= strTime;   
          } 


           const updateUser = await prisma.pickup.update({
            where: {
              id: obj.pickup_id,
            },
            data: {
			  ...(pickup_date ? { pickup_date_3: pickup_date } : {}),
              ...(obj.destination ? { current_branch_id: obj.destination } : {}),
              i_delivery_status_id_18: obj.i_delivery_status_id_18,
              ...(obj.delivery_boy_id ? { delivery_boy_id: obj.delivery_boy_id } : {}),
              ...(date_ ? { delivery_boy_date: date_} : {}),
              ...(obj.i_relation_person ? { i_relation_person: obj.i_relation_person } : {}),
              ...(obj.i_relation_id ? { i_relation_id: obj.i_relation_id } : {}),
              ...(obj.i_return_cause_id ? { i_return_cause_id: obj.i_return_cause_id } : {}),
              ...(delivery_boy_area ? { delivery_boy_area:delivery_boy_area  } : {}),
              ...(time ? { delivery_date: obj.date+" "+time } : {}), 
            },
          })

      } 
 
      if(pickup_ids.length>0){
            const updateUser3 = await prisma.pickup_tracking.updateMany({
              where: {
                pickup_id: {
                  in: pickup_ids,
                },
              },
              data: {
                note: 'R',
              },
            })
          }

     /*if(pickup_ids.length>0){
        const updateUser2 = await prisma.pickup_tracking.update({
          where: {
           pickup_id: { in:pickup_ids },
          },
          data: {
            note:'Received'
          },
        })
      }*/
 

          res.json({
            act:act,
            pickup_ids:pickup_ids,
        result: createMany
      });
  
      
  }catch(error){
     next(error)
  }
})




app.post('/api/create_pickup_tracking_noduplicate',auth, async (req, res, next) => {
  try{

    //insert
     const data = req.body
    console.log(1111,data)
     for(let k=0; k<data.length; k++){
      let this_pickup_id=data[k].pickup_id
      let this_i_delivery_status_id_18=data[k].i_delivery_status_id_18
      let this_source=data[k].source
      let this_destination=data[k].destination

              let findtrac = await prisma.pickup_tracking.findFirst({
                where: {
                  pickup_id:this_pickup_id
                },
                orderBy: {
                  id: "desc"
                }
              })
            
             console.log(findtrac?.i_delivery_status_id_18,'/',this_i_delivery_status_id_18,'/',findtrac?.source,'/',this_source,findtrac?.destination,'/',this_destination,'xxx')

              if(findtrac){
               console.log('duplicate1')
                if(findtrac?.i_delivery_status_id_18==this_i_delivery_status_id_18 && 
                  findtrac?.source==this_source && 
                  findtrac?.destination==this_destination){
                    console.log('duplicate',this_pickup_id)
                        return res.json({
                          act:null,
                          pickup_ids:null,
                          result: null
                        });
                  }else{

                                    



                   }
              }






              

              console.log('createMany')
              const createMany = await prisma.pickup_tracking.createMany({
                data: req.body ,
                skipDuplicates: true, 
              })
        
        
              //update 
              var count ='';
              const get_=req.body;
              var pickup_ids=[]
              var act
              for (var i = 0; i < get_.length; i++){
                  let date_
				  let pickup_date=null
                  var obj = get_[i];
                  count =obj.i_delivery_status_id_18;
                  act=obj.action_type
                  if(obj.action_type=='update_to_shipped'){
                    pickup_ids.push(obj.pickup_id)
                  }  


                  var delivery_boy_area=null
                  if(obj.action_type=='send_to_deliveryman'){
                      delivery_boy_area=obj.pickup_reference_id
                      date_ = obj.date.substring(0, 10);
                  }  
				  
				  
					if(obj.i_delivery_status_id_18==3){
						let vdate_ = obj.date.substring(0, 10);
						pickup_date=vdate_
					}
        
                  var time = obj.time
                  let date2_ = obj.date;


                if(time){
                    const myArray = time.split(":");
                  
                var hours = myArray[0];
                var minutes = myArray[1];
                var ampm = hours >= 12 ? 'pm' : 'am';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? '0'+minutes : minutes;
                var strTime = hours + ':' + minutes + ' ' + ampm;
                time= strTime;   
                  } 


                  const updateUser = await prisma.pickup.update({
                    where: {
                      id: obj.pickup_id,
                    },
                    data: {
					  ...(pickup_date ? { pickup_date_3: pickup_date } : {}),
                      ...(obj.destination ? { current_branch_id: obj.destination } : {}),
                      i_delivery_status_id_18: obj.i_delivery_status_id_18,
                      ...(obj.delivery_boy_id ? { delivery_boy_id: obj.delivery_boy_id } : {}),
                      ...(date_ ? { delivery_boy_date: date_} : {}),
                      ...(obj.i_relation_person ? { i_relation_person: obj.i_relation_person } : {}),
                      ...(obj.i_relation_id ? { i_relation_id: obj.i_relation_id } : {}),
                      ...(obj.i_return_cause_id ? { i_return_cause_id: obj.i_return_cause_id } : {}),
                      ...(delivery_boy_area ? { delivery_boy_area:delivery_boy_area  } : {}),
                      ...(time ? { delivery_date: obj.date+" "+time } : {}), 
                    },
                  })

              } 
        
              if(pickup_ids.length>0){
                    const updateUser3 = await prisma.pickup_tracking.updateMany({
                      where: {
                        pickup_id: {
                          in: pickup_ids,
                        },
                      },
                      data: {
                        note: 'R',
                      },
                    })
                  }
        
                  res.json({
                    act:act,
                    pickup_ids:pickup_ids,
                result: createMany
              });



             





    }  




    return res.json({
      act:null,
      pickup_ids:null,
      result: null
    });
  
      
  }catch(error){
     next(error)
  }
})


app.post('/api/create_shipment_multiple',auth, async (req, res, next) => {
  try{

     const data = req.body
      const createMany = await prisma.pickup.createMany({
        data: req.body ,
        skipDuplicates: true, 
      })
      res.json({
        result: createMany
      });
      
  }catch(error){
     next(error)
  }
})

app.post('/api/update_shipment_multiple',auth, async (req, res, next) => {
  try{

     const data = req.body
	 
	 	  for(let i=0; i<data.length; i++){
		    let oo=data[i]
			let idd=oo.id
			delete oo.id
		    let updateUser = await prisma.pickup.update({
				  where: {id: idd,
					
				  },
				  data:oo,
				})
	     }
 
      res.json({
        result: true
      });
      
  }catch(error){
     next(error)
  }
})

app.post('/api/set_otp_db',auth, async (req, res, next) => {
  try{

     const data = req.body
 
 const otp = Math.floor(Math.random() * 9000 + 1000);


     const updateUser = await prisma.pickup.update({
      where: {
        id:data.id
      },
      data: {
        otp: otp,
      },
    })

      res.json({
        result: updateUser,
      });



  }catch(error){
    next(error)
 }
})

app.post('/api/otpverify',auth, async (req, res, next) => {
  try{

     const data = req.body
var result2=0;

     const result = await prisma.pickup.findMany({
      where: {
        id:data.selected_rows
      },
      })


      if(result[0].otp==data.otp){
        result2=1;

        const updateUser = await prisma.pickup.update({
          where: {
            id:data.selected_rows
          },
          data: {
            otp_verified: 1,
          },
        })
		
		//verified
		 res.status(200).json({message:"verify"});
      }else{
        result2=0;
 
		
      }



      res.status(201).json({message:"not"});



  }catch(error){
    next(error)
 }
})



app.post('/api/get_tracking',auth, async (req, res, next) => {
  try{

     const data = req.body

     const result = await prisma.pickup_tracking.findMany({
      where: {
        pickup_id:data.selected_rows
      },
      include: {

        delivery_boy_id_: {
          select:{
            userName:true,
            userID:true,
            employee_id : true,
          }
        }, 
        i_relation: {
          select:{
            i_relation:true,
          }
        }, 
        i_return_cause: {
          select:{
            i_return_cause:true,
          }
        },

        i_delivery_status: {
          select:{
            i_delivery_status:true,
          }
        }, 
        i_tracking_status: {
          select:{
            i_tracking_status:true,
          }
        }, 
        branch_destination: {
          select:{
            branch:true,
          }
        }, 
        branch_source: {
          select:{
            branch:true,
          }
        },
        creator_:{
          select:{
            userName:true,
          }
          
        } 
      },

      })

      res.json({
        result: result,
      });



  }catch(error){
    next(error)
 }
})

app.get('/api/tracking-list-v2',marchant, async (req, res) => {
  try{

     const data = req.body

     const result = await prisma.pickup_tracking.findMany({
      where: {
        pickup_id:parseInt(data.pickup_id)
      },
      include: {

        delivery_boy_id_: {
          select:{
            userName:true,
            userID:true,
            employee_id : true,
          }
        }, 
        i_relation: {
          select:{
            i_relation:true,
          }
        }, 
        i_return_cause: {
          select:{
            i_return_cause:true,
          }
        },

        i_delivery_status: {
          select:{
            i_delivery_status:true,
          }
        }, 
        i_tracking_status: {
          select:{
            i_tracking_status:true,
          }
        }, 
        branch_destination: {
          select:{
            branch:true,
          }
        }, 
        branch_source: {
          select:{
            branch:true,
          }
        },
        creator_:{
          select:{
            userName:true,
          }
          
        } 
      },

      })



      let result_col=[]


for(var i=0; i<result?.length; i++){
 
  var obj = result[i];

  var t1_date= obj.date
  var t1_hour=''


  if(obj.date.length>11){
  t1_hour = obj.date.slice(11, 13);
  var end='AM'
  if(t1_hour>12){ t1_hour=t1_hour-12;  
   if(t1_hour.toString().length==1){t1_hour='0'+t1_hour}
  end='PM'  }
  var t1_min = obj.date.slice(14, 16);
  t1_hour='('+t1_hour+':'+t1_min+' '+end+')'                
  }


  
 // if(obj.date.slice(11, 16))

  //var f_d = obj.i_delivery_status.i_delivery_status + ' (' + obj.i_tracking_status.i_tracking_status + ')';
  var f_d = obj.i_delivery_status.i_delivery_status;


  var NEW_TRA=""
  if(obj.i_tracking_status.i_tracking_status){
      if(obj.i_tracking_status.i_tracking_status==f_d){
          NEW_TRA=obj.i_tracking_status.i_tracking_status
      }else{
          NEW_TRA=f_d+" ("+obj.i_tracking_status.i_tracking_status+")"
      }
  }else{
      NEW_TRA=f_d
  }

  var x_data = {
    tracking_id: obj.id,
    action_type: obj.action_type,
    date: t1_date+' '+t1_hour,
    time:obj.time,    
    source: obj.branch_source.branch,

    destination: obj.branch_destination.branch,
    delivery_status: f_d,
    tracking_status: NEW_TRA,
    note: obj.pickup_reference_id,
    
    ...(obj.i_relation_id ? { relation: obj.i_relation.i_relation } : {relation:'' }),
    ...(obj.delivery_boy_id ? { delivery_boy: obj.delivery_boy_id_.userName } : { }),
    ...(obj.i_relation_person ? { relation_person: obj.i_relation_person} : {relation_person:''}),

    ...(obj.i_return_cause_id ? { return_cause: obj.i_return_cause.i_return_cause } : { }),
    

 

  
}

result_col.push(x_data);

 
}


 


      res.json( 
        result_col,
       );



  }catch(error){
    console.log(error,'error')
    res.json({
      message: "Invalid Pickup Id",
    });
   
 }
})

app.post('/api/search_data',auth, async (req, res, next) => {
  try{

     const data = req.body

     var current_branch_id=req.body.current_branch_id
     const services_id_1=req.body.services_id_1
     const i_product_type_id_2=req.body.i_product_type_id_2
     const i_payment_type_8=req.body.i_payment_type_8
     const creator=req.body.creator



     var delivery_boy_id
     if(req.body.is_delivery_boy==1){
      delivery_boy_id=req.body.user_id
     }else{
      delivery_boy_id=req.body.delivery_boy_id
     }
     



     var pickup_ids=[]
     const shipment_ref=req.body.shipment_ref

      


     if(shipment_ref){
        //get all pickup id from tracking
          

            const pickup_tracking = await prisma.pickup_tracking.findMany(
                {
                  where: {  
                    AND: [
                        {
                          pickup_reference_id: shipment_ref,
                        }
                      ]
                    },
                }
                )
        
        
                if(pickup_tracking){
                  for(let i = 0; i < pickup_tracking.length; i++) {
                    let obj = pickup_tracking[i];
                    pickup_ids.push(obj.pickup_id)
                  }
                   current_branch_id=null
                }
               
     }



     const sender_category_1=req.body.sender_category_1
 

     const pickup_date_3=req.body.pickup_date_3
     const sender_phone_5=req.body.sender_phone_5
     const sender_client_id_7=req.body.sender_client_id_7
     const sender_client_branch_id_8=req.body.sender_client_branch_id_8
     const recipient_category_14=req.body.recipient_category_14
     const delivery_type_15=req.body.delivery_type_15
     const i_shipment_method_id_17=req.body.i_shipment_method_id_17
     const i_delivery_status_id_18=req.body.i_delivery_status_id_18 
     const i_tracking_status_id_19=req.body.i_tracking_status_id_19
     const recipient_client_id_22=req.body.recipient_client_id_22
     const recipient_client_branch_id_23=req.body.recipient_client_branch_id_23
     const sender_ref_no_4=req.body.sender_ref_no_4


     let have_mul_ref=0
     let _mul=[]
     if(sender_ref_no_4){

          _mul = sender_ref_no_4.split(" ") 
          if(_mul.length>1){
            have_mul_ref=1
          }
          
     }

    


     const recipient_phone_20=req.body.recipient_phone_20

     const charge_trxid=req.body.charge_trxid
     const collection_trxid=req.body.collection_trxid


     var range_start=req.body.range_start
     var range_end=req.body.range_end
     const unique_upload_id=req.body.unique_upload_id
     
     const take=req.body.rowsPerPage
     const skip=req.body.page*req.body.rowsPerPage
     

     const user_id=req.body.user_id
     const is_marchant=req.body.is_marchant

    const assign_date=null
     const checked_pickup=req.body.checked_pickup





    var range_start_assign=null
    var range_end_assign=null

    if(checked_pickup==true || checked_pickup==1 ){
        range_start_assign=null
        range_end_assign=null
    }else{ 
      range_start_assign=range_start
      range_end_assign=range_end
      
      range_end=null
      range_start=null
    } 


    // const user_id=req.body.user_id 

     var unique=[]
     if(user_id>0 && is_marchant==1){//so marchant
      current_branch_id=null;
       const services_clients_branch = await prisma.services_clients_branch.findMany(
           {
             where: {  
               AND: [
                   {
                     ...(user_id > 0 ? { userID: user_id } : {}),
                   }
                 ]
               },
           }
           )
   
   
           if(user_id > 0){
             for(let i = 0; i < services_clients_branch.length; i++) {
               let obj = services_clients_branch[i];
               unique.push(obj.services_clients_id)
             }
           }
     }


     //creator=null  ...(creator ? { creator: creator } : {}),

     if(req.body.i_delivery_status_count!=null){
      i_delivery_status_id_18=req.body.i_delivery_status_count
     }

     const result = await prisma.pickup.findMany({
      ...(skip ? { skip: skip } : {}),
      ...(take ? { take: take } : {}),
 
      orderBy: {
             
        id: 'desc',
      
    },
  //...(pickup_date_3 ? { pickup_date_3: pickup_date_3 } : {}),
  where: {
    AND: [
        {
          ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),
          ...(services_id_1 ? { services_id_1: services_id_1 } : {}),
          ...(i_product_type_id_2 ? { i_product_type_id_2: i_product_type_id_2 } : {}),
          ...(i_payment_type_8 ? { i_payment_type_8: i_payment_type_8 } : {}),
        
          ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}), 
         
          ...(pickup_ids.length>0 ? {  id: { in:pickup_ids }, } : {}), 
          


          ...(unique_upload_id ? { unique_upload_id: unique_upload_id } : {}),
          ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),
          ...(sender_phone_5 ? { sender_phone_5: sender_phone_5 } : {}),
          ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),
          ...(sender_client_branch_id_8 ? { sender_client_branch_id_8: sender_client_branch_id_8 } : {}),
      
          ...(charge_trxid ? { charge_trxid: charge_trxid } : {}),
          ...(collection_trxid ? { collection_trxid: collection_trxid } : {}),

          ...(i_shipment_method_id_17 ? { i_shipment_method_id_17: i_shipment_method_id_17 } : {}),
          ...(i_delivery_status_id_18 ? { i_delivery_status_id_18: i_delivery_status_id_18 } : {}),
          ...(i_tracking_status_id_19 ? { i_tracking_status_id_19: i_tracking_status_id_19 } : {}),
          ...(recipient_client_id_22 ? { recipient_client_id_22: recipient_client_id_22 } : {}),
          ...(recipient_client_branch_id_23 ? { recipient_client_branch_id_23: recipient_client_branch_id_23 } : {}),



          ...(have_mul_ref==1 ? { sender_ref_no_4: { in:_mul }, } : {
            ...(sender_ref_no_4 ? { sender_ref_no_4: sender_ref_no_4 } : {}),
          }),

          

          ...(recipient_phone_20 ? { recipient_phone_20: recipient_phone_20 } : {}),

        },
        
        {
        pickup_date_3: {
          ...(range_end ? { lte: range_end } : {}),
          ...(range_start ? { gte: range_start } : {}),
         
        },
        }

        ,
        {
          delivery_boy_date: {
          ...(range_start_assign ? { lte: range_start_assign } : {}),
          ...(range_end_assign ? { gte: range_end_assign } : {}),
        },
        }
 
      ]
 
 

    },

  include: {
    delivery_boy_id_: {
      select:{
        userName:true,
        userID:true,
        employee_id : true,
      }
    }, 
    i_relation: {
      select:{
        i_relation:true,
      }
    }, 
    i_return_cause: {
      select:{
        i_return_cause:true,
      }
    },
    services: {
      select:{
        services:true,
      }
    }, 
    i_product_type: {
      select:{
        i_product_type:true,
      }
    }, 
    i_priority: {
      select:{
        i_priority:true,
      }
    }, 
    i_payment_type: {
      select:{
        i_payment_type:true,
      }
    }, 
    i_packaging_type: {
      select:{
        i_packaging_type:true,
      }
    }, 
    i_shipment_method: {
      select:{
        i_shipment_method:true,
      }
    }, 
    i_delivery_status: {
      select:{
        i_delivery_status:true,
      }
    },
    i_tracking_status: {
      select:{
        i_tracking_status:true,
      }
    },
    current_branch: {
      select:{
        branch:true,
      }
    },
    created_branch_: {
      select:{
        branch:true,
      }
    },
    creator1_: {
      select:{
        userName:true,
      }
    }
  },
})


/*console.log(        {
  pickup_date_3: {
    ...(range_end ? { lte: range_end } : {}),
    ...(range_start ? { gte: range_start } : {}),
   
  },

})

console.log( 
{
  delivery_boy_date: {
  ...(range_start_assign ? { lte: range_start_assign } : {}),
  ...(range_end_assign ? { gte: range_end_assign } : {}),
},
},'xxxxxxxxx')*/

const counts_ = await prisma.pickup.count({
where: {
AND: [
    {
      ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),
      ...(services_id_1 ? { services_id_1: services_id_1 } : {}),
      ...(i_product_type_id_2 ? { i_product_type_id_2: i_product_type_id_2 } : {}),
      ...(i_payment_type_8 ? { i_payment_type_8: i_payment_type_8 } : {}),
      ...(sender_phone_5 ? { sender_phone_5: sender_phone_5 } : {}),
      ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),
      ...(sender_client_branch_id_8 ? { sender_client_branch_id_8: sender_client_branch_id_8 } : {}),
      ...(i_shipment_method_id_17 ? { i_shipment_method_id_17: i_shipment_method_id_17 } : {}),
      ...(i_delivery_status_id_18 ? { i_delivery_status_id_18: i_delivery_status_id_18 } : {}),
      ...(i_tracking_status_id_19 ? { i_tracking_status_id_19: i_tracking_status_id_19 } : {}),
      ...(recipient_client_id_22 ? { recipient_client_id_22: recipient_client_id_22 } : {}),
      ...(recipient_client_branch_id_23 ? { recipient_client_branch_id_23: recipient_client_branch_id_23 } : {}),

      ...(have_mul_ref==1 ? { sender_ref_no_4: { in:_mul }, } : {
        ...(sender_ref_no_4 ? { sender_ref_no_4: sender_ref_no_4 } : {}),
      }),

      ...(recipient_phone_20 ? { recipient_phone_20: recipient_phone_20 } : {}),
      ...(unique_upload_id ? { unique_upload_id: unique_upload_id } : {}),
      ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),
      ...(pickup_ids.length>0 ? {  id: { in:pickup_ids }, } : {}), 

      ...(charge_trxid ? { charge_trxid: charge_trxid } : {}),
      ...(collection_trxid ? { collection_trxid: collection_trxid } : {}),
    },
    
    {
    pickup_date_3: {
      ...(range_end ? { lte: range_end } : {}),
      ...(range_start ? { gte: range_start } : {}),
    },
    },

    ,
    {
      delivery_boy_date: {
      ...(range_start_assign ? { lte: range_start_assign } : {}),
      ...(range_end_assign ? { gte: range_end_assign } : {}),
    },
    }
  ]
},
})






     /* const createMany = await prisma.pickup.createMany({
        data: req.body ,
        skipDuplicates: true, 
      })*/
      res.json({ 
        shipment_ref:shipment_ref,
        pickup_ids:pickup_ids,
        delivery_boy_id:delivery_boy_id,
        result: result,
        counts_:counts_,
        pickup:pickup_date_3
      });
      
  }catch(error){
     next(error)
  }
})

/*app.post('/api/create_shipment/:postId', async (req, res) => {
  //const { title, content, authorEmail } = req.body
  const { postId } = req.params
  res.json({
    number: postId
  });
  
})*/

app.get('/api/pickup-query-v2',marchant, async (req, res) => {

  try{

    const data = req.body

    var current_branch_id=req.body.current_branch_id
    const services_id_1=req.body.services_id_1
    const i_product_type_id_2=req.body.i_product_type_id_2
    const i_payment_type_8=req.body.i_payment_type_8
    const creator=req.body.creator

 

    var delivery_boy_id
    if(req.body.is_delivery_boy==1){
     delivery_boy_id=req.body.user_id
    }else{
     delivery_boy_id=req.body.delivery_boy_id
    }
    



    var pickup_ids=[]
    const shipment_ref=req.body.shipment_ref

     


    if(shipment_ref){
       //get all pickup id from tracking
         

           const pickup_tracking = await prisma.pickup_tracking.findMany(
               {
                 where: {  
                   AND: [
                       {
                         pickup_reference_id: shipment_ref,
                       }
                     ]
                   },
               }
               )
       
       
               if(pickup_tracking){
                 for(let i = 0; i < pickup_tracking.length; i++) {
                   let obj = pickup_tracking[i];
                   pickup_ids.push(obj.pickup_id)
                 }
                  current_branch_id=null
               }
              
    }



    const sender_category_1=req.body.sender_category_1


    const pickup_date_3=req.body.pickup_date_3
    const sender_phone_5=req.body.sender_phone_5
    const sender_client_id_7=req.body.sender_client_id_7
    const sender_client_branch_id_8=req.body.sender_client_branch_id_8
    const recipient_category_14=req.body.recipient_category_14
    const delivery_type_15=req.body.delivery_type_15
    const i_shipment_method_id_17=req.body.i_shipment_method_id_17
    let i_delivery_status_id_18=req.body.delivery_status 

    if(i_delivery_status_id_18){
      const yyy = await prisma.i_delivery_status.findMany(
        {
          where: {  
            AND: [
                {
                  i_delivery_status: i_delivery_status_id_18,
                }
              ]
            },
        }
        )

        if(yyy?.length>0){
            i_delivery_status_id_18=yyy[0].i_delivery_status_id
        }else{
          res.status(201).json({message:"Invalid Delivery Status Name"});
        }
       
    }




    const i_tracking_status_id_19=req.body.i_tracking_status_id_19
    const recipient_client_id_22=req.body.recipient_client_id_22
    const recipient_client_branch_id_23=req.body.recipient_client_branch_id_23
    const sender_ref_no_4=req.body.reference_no


    let have_mul_ref=0
    let _mul=[]
    if(sender_ref_no_4){

         _mul = sender_ref_no_4.split(" ") 
         if(_mul.length>1){
           have_mul_ref=1
         }
         
    }

   


    const recipient_phone_20=req.body.recipient_phone_20

    const charge_trxid=req.body.charge_trxid
    const collection_trxid=req.body.collection_trxid


    var range_start=req.body.range_start
    var range_end=req.body.range_end
    const unique_upload_id=req.body.unique_upload_id
    

let rowsPerPagex=req.body.rows_per_page || '10'
let pagex=req.body.page_no || '1'

    const take=parseInt(rowsPerPagex)
    const skip=parseInt(pagex-1)*parseInt(rowsPerPagex)
    

    const user_id=req.body.user_id
    const is_marchant=req.body.is_marchant

   const assign_date=null
    let checked_pickup=req.body.checked_pickup

let range_filter=req.body.range_filter || 'pickup_date_wise'

if(range_filter=='pickup_date_wise'){
  checked_pickup=true
}else{
  checked_pickup=false
}

   var range_start_assign=null
   var range_end_assign=null

   if(checked_pickup==true || checked_pickup==1 ){
       range_start_assign=null
       range_end_assign=null
   }else{ 
     range_start_assign=range_start
     range_end_assign=range_end
     
     range_end=null
     range_start=null
   } 


   // const user_id=req.body.user_id 

    var unique=[]
    if(user_id>0){//so marchant
     current_branch_id=null;
      const services_clients_branch = await prisma.services_clients_branch.findMany(
          {
            where: {  
              AND: [
                  {
                    ...(user_id > 0 ? { userID: user_id } : {}),
                  }
                ]
              },
          }
          )
  
  
          if(user_id > 0){
            for(let i = 0; i < services_clients_branch.length; i++) {
              let obj = services_clients_branch[i];
              unique.push(obj.services_clients_id)
            }
          }
    }


    //creator=null  ...(creator ? { creator: creator } : {}),

    if(req.body.i_delivery_status_count!=null){
     i_delivery_status_id_18=req.body.i_delivery_status_count
    }


   /* res.json( {
      AND: [
          {
            ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),
            ...(services_id_1 ? { services_id_1: services_id_1 } : {}),
            ...(i_product_type_id_2 ? { i_product_type_id_2: i_product_type_id_2 } : {}),
            ...(i_payment_type_8 ? { i_payment_type_8: i_payment_type_8 } : {}),
          
            ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}), 
           
            ...(pickup_ids.length>0 ? {  id: { in:pickup_ids }, } : {}), 
            
   
   
            ...(unique_upload_id ? { unique_upload_id: unique_upload_id } : {}),
            ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),
            ...(sender_phone_5 ? { sender_phone_5: sender_phone_5 } : {}),
            ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),
            ...(sender_client_branch_id_8 ? { sender_client_branch_id_8: sender_client_branch_id_8 } : {}),
        
            ...(charge_trxid ? { charge_trxid: charge_trxid } : {}),
            ...(collection_trxid ? { collection_trxid: collection_trxid } : {}),
   
            ...(i_shipment_method_id_17 ? { i_shipment_method_id_17: i_shipment_method_id_17 } : {}),
            ...(i_delivery_status_id_18 ? { i_delivery_status_id_18: i_delivery_status_id_18 } : {}),
            ...(i_tracking_status_id_19 ? { i_tracking_status_id_19: i_tracking_status_id_19 } : {}),
            ...(recipient_client_id_22 ? { recipient_client_id_22: recipient_client_id_22 } : {}),
            ...(recipient_client_branch_id_23 ? { recipient_client_branch_id_23: recipient_client_branch_id_23 } : {}),
   
   
   
            ...(have_mul_ref==1 ? { sender_ref_no_4: { in:_mul }, } : {
              ...(sender_ref_no_4 ? { sender_ref_no_4: sender_ref_no_4 } : {}),
            }),
   
            
   
            ...(recipient_phone_20 ? { recipient_phone_20: recipient_phone_20 } : {}),
   
          },
          
          {
          pickup_date_3: {
            ...(range_end ? { lte: range_end } : {}),
            ...(range_start ? { gte: range_start } : {}),
           
          },
          }
   
          ,
          {
            delivery_boy_date: {
            ...(range_start_assign ? { lte: range_start_assign } : {}),
            ...(range_end_assign ? { gte: range_end_assign } : {}),
          },
          }
   
        ]
   
   
   
      });*/
 



    const result = await prisma.pickup.findMany({
     ...(skip ? { skip: skip } : {}),
     ...(take ? { take: take } : {}),

     orderBy: {
            
       id: 'desc',
     
   },
 //...(pickup_date_3 ? { pickup_date_3: pickup_date_3 } : {}),
 where: {
   AND: [
       {
         ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),
         ...(services_id_1 ? { services_id_1: services_id_1 } : {}),
         ...(i_product_type_id_2 ? { i_product_type_id_2: i_product_type_id_2 } : {}),
         ...(i_payment_type_8 ? { i_payment_type_8: i_payment_type_8 } : {}),
       
         ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}), 
        
         ...(pickup_ids.length>0 ? {  id: { in:pickup_ids }, } : {}), 
         


         ...(unique_upload_id ? { unique_upload_id: unique_upload_id } : {}),
         ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),
         ...(sender_phone_5 ? { sender_phone_5: sender_phone_5 } : {}),
         ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),
         ...(sender_client_branch_id_8 ? { sender_client_branch_id_8: sender_client_branch_id_8 } : {}),
     
         ...(charge_trxid ? { charge_trxid: charge_trxid } : {}),
         ...(collection_trxid ? { collection_trxid: collection_trxid } : {}),

         ...(i_shipment_method_id_17 ? { i_shipment_method_id_17: i_shipment_method_id_17 } : {}),
         ...(i_delivery_status_id_18 ? { i_delivery_status_id_18: i_delivery_status_id_18 } : {}),
         ...(i_tracking_status_id_19 ? { i_tracking_status_id_19: i_tracking_status_id_19 } : {}),
         ...(recipient_client_id_22 ? { recipient_client_id_22: recipient_client_id_22 } : {}),
         ...(recipient_client_branch_id_23 ? { recipient_client_branch_id_23: recipient_client_branch_id_23 } : {}),



         ...(have_mul_ref==1 ? { sender_ref_no_4: { in:_mul }, } : {
           ...(sender_ref_no_4 ? { sender_ref_no_4: sender_ref_no_4 } : {}),
         }),

         

         ...(recipient_phone_20 ? { recipient_phone_20: recipient_phone_20 } : {}),

       },
       
       {
       pickup_date_3: {
         ...(range_end ? { lte: range_end } : {}),
         ...(range_start ? { gte: range_start } : {}),
        
       },
       }

       ,
       {
         delivery_boy_date: {
         ...(range_start_assign ? { lte: range_start_assign } : {}),
         ...(range_end_assign ? { gte: range_end_assign } : {}),
       },
       }

     ]



   },

 include: {
   delivery_boy_id_: {
     select:{
       userName:true,
       userID:true,
       employee_id : true,
     }
   }, 
   i_relation: {
     select:{
       i_relation:true,
     }
   }, 
   i_return_cause: {
     select:{
       i_return_cause:true,
     }
   },
   services: {
     select:{
       services:true,
     }
   }, 
   i_product_type: {
     select:{
       i_product_type:true,
     }
   }, 
   i_priority: {
     select:{
       i_priority:true,
     }
   }, 
   i_payment_type: {
     select:{
       i_payment_type:true,
     }
   }, 
   i_packaging_type: {
     select:{
       i_packaging_type:true,
     }
   }, 
   i_shipment_method: {
     select:{
       i_shipment_method:true,
     }
   }, 
   i_delivery_status: {
     select:{
       i_delivery_status:true,
     }
   },
   i_tracking_status: {
     select:{
       i_tracking_status:true,
     }
   },
   current_branch: {
     select:{
       branch:true,
     }
   },
   created_branch_: {
     select:{
       branch:true,
     }
   },
   creator1_: {
     select:{
       userName:true,
     }
   }
 },
})





const counts_ = await prisma.pickup.count({
where: {
AND: [
   {
     ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),
     ...(services_id_1 ? { services_id_1: services_id_1 } : {}),
     ...(i_product_type_id_2 ? { i_product_type_id_2: i_product_type_id_2 } : {}),
     ...(i_payment_type_8 ? { i_payment_type_8: i_payment_type_8 } : {}),
     ...(sender_phone_5 ? { sender_phone_5: sender_phone_5 } : {}),
     ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),
     ...(sender_client_branch_id_8 ? { sender_client_branch_id_8: sender_client_branch_id_8 } : {}),
     ...(i_shipment_method_id_17 ? { i_shipment_method_id_17: i_shipment_method_id_17 } : {}),
     ...(i_delivery_status_id_18 ? { i_delivery_status_id_18: i_delivery_status_id_18 } : {}),
     ...(i_tracking_status_id_19 ? { i_tracking_status_id_19: i_tracking_status_id_19 } : {}),
     ...(recipient_client_id_22 ? { recipient_client_id_22: recipient_client_id_22 } : {}),
     ...(recipient_client_branch_id_23 ? { recipient_client_branch_id_23: recipient_client_branch_id_23 } : {}),

     ...(have_mul_ref==1 ? { sender_ref_no_4: { in:_mul }, } : {
       ...(sender_ref_no_4 ? { sender_ref_no_4: sender_ref_no_4 } : {}),
     }),

     ...(recipient_phone_20 ? { recipient_phone_20: recipient_phone_20 } : {}),
     ...(unique_upload_id ? { unique_upload_id: unique_upload_id } : {}),
     ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),
     ...(pickup_ids.length>0 ? {  id: { in:pickup_ids }, } : {}), 

     ...(charge_trxid ? { charge_trxid: charge_trxid } : {}),
     ...(collection_trxid ? { collection_trxid: collection_trxid } : {}),
   },
   
   {
   pickup_date_3: {
     ...(range_end ? { lte: range_end } : {}),
     ...(range_start ? { gte: range_start } : {}),
   },
   },

   ,
   {
     delivery_boy_date: {
     ...(range_start_assign ? { lte: range_start_assign } : {}),
     ...(range_end_assign ? { gte: range_end_assign } : {}),
   },
   }
 ]
},
})


console.log(        {
  pickup_date_3: {
    ...(range_end ? { lte: range_end } : {}),
    ...(range_start ? { gte: range_start } : {}),
   
  },

})

console.log( 
{
  delivery_boy_date: {
  ...(range_start_assign ? { lte: range_start_assign } : {}),
  ...(range_end_assign ? { gte: range_end_assign } : {}),
},
},'xxxxxxxxx')

let result_col=[]
for(var i=0; i<result?.length; i++){
  let ob=result[i]

    result_col.push({
      "pickup_id" : ob.id,
      pickup_date: ob.pickup_date_3,
      reference_no: ob.sender_ref_no_4,
      recipient: 
      {
        name:ob.recipient_name_21,
        phone:ob.recipient_phone_20,
        address:ob.recipient_address_24,
      },

      collection_amount: 
      {
        total:ob.collection_amount,
        settlement:ob.amount_to_wallet || 0
      },
 
      services:ob.services.services,
      product_type:ob.i_product_type.i_product_type,
      priority:ob.i_priority.i_priority,
      payment_type:ob.i_payment_type.i_payment_type,
      delivery_status:ob.i_delivery_status.i_delivery_status,
      ...(ob.i_delivery_status.i_delivery_status=='Delivered' ? { otp_verify: ob.otp_verified || '0' } : {}),
      tracking_status:ob.i_tracking_status.i_tracking_status,
      current_branch:ob.current_branch.current_branch
    })
}  



    /* const createMany = await prisma.pickup.createMany({
       data: req.body ,
       skipDuplicates: true, 
     })      result: result,*/
     res.json({ 
      counts_:counts_,
      rows_per_page:rowsPerPagex,
      page_no:pagex,
      result: result,
      result:result_col,
     });
     
 }catch(error){ 
    //next(error)
    
    console.log(error,'111')
    res.json(error);
 }
})




app.post('/api/search_data_id',auth, async (req, res, next) => {
  try{

     const data = req.body

     var current_branch_id=req.body.current_branch_id
     var ids=req.body.ids
     var user_id=req.body.user_id
     var is_marchant=req.body.is_marchant


 console.log('xxx')
console.log(ids,'xxx')
     var delivery_boy_id
     if(req.body.is_delivery_boy==1){
      delivery_boy_id=req.body.user_id
     }


     var unique_users=[]
     if(user_id>0 && is_marchant==1){//so marchant
      current_branch_id=null;
       const services_clients_branch = await prisma.services_clients_branch.findMany(
           {
             where: {  
               AND: [
                   {
                     ...(user_id > 0 ? { userID: user_id } : {}),
                     ...(unique_users.length>0 ? {  sender_client_id_7: { in:unique_users }, } : {}), 
                   }
                 ]
               },
           }
           )
   
   
           if(user_id > 0){
             for(let i = 0; i < services_clients_branch.length; i++) {
               let obj = services_clients_branch[i];
               unique_users.push(obj.services_clients_id)
             }
           }
     }

     var unique=[]

     if(isNaN(ids)){
    
            
          var nameArr = ids.split(',');

          var nums = nameArr.map(function(str) {
            // using map() to convert array of strings to numbers

            return parseInt(str); });
            
            unique = nums.reduce(function (acc, curr) {
              if (!acc.includes(curr))
                  acc.push(curr);
              return acc;
          }, []);


     }else{
      
      unique[0]= parseInt(ids);
      

     }


    let have_mul_ref=0
     let _mul=[]
     if(isNaN(ids)){

          _mul = ids?.split(" ") 
          if(_mul.length>1){
            have_mul_ref=1

              var resultvv = _mul.map(function (x) { 
                return parseInt(x, 10); 
              }); 

              _mul=resultvv

          }  
     }



     const result = await prisma.pickup.findMany({

  //...(pickup_date_3 ? { pickup_date_3: pickup_date_3 } : {}),
  where: {
    AND: [
        {
          ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),
           ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),
           ...(unique_users.length>0 ? {  sender_client_id_7: { in:unique_users }, } : {}),      


          ...(have_mul_ref==1 ? { id: { in:_mul }, } : {
            id: { in:unique },
          }),


        },
      
   
      ],
    },

  include: {
    delivery_boy_id_: {
      select:{
        userName:true,
        userID:true,
        employee_id : true,
      }
    }, 
    i_relation: {
      select:{
        i_relation:true,
      }
    }, 
    i_return_cause: {
      select:{
        i_return_cause:true,
      }
    }, 
    services: {
      select:{
        services:true,
      }
    }, 
    i_product_type: {
      select:{
        i_product_type:true,
      }
    }, 
    i_priority: {
      select:{
        i_priority:true,
      }
    }, 
    i_payment_type: {
      select:{
        i_payment_type:true,
      }
    }, 
    i_packaging_type: {
      select:{
        i_packaging_type:true,
      }
    }, 
    i_shipment_method: {
      select:{
        i_shipment_method:true,
      }
    }, 
    i_delivery_status: {
      select:{
        i_delivery_status:true,
      }
    },
    i_tracking_status: {
      select:{
        i_tracking_status:true,
      }
    },
    current_branch: {
      select:{
        branch:true,
      }
    },
    created_branch_: {
      select:{
        branch:true,
      }
    },
    creator1_: {
      select:{
        userName:true,
      }
    },
    charge_trxid_: {
      select:{
        created:true,
        creator_: {
          select:{
            userName:true,
            userID:true,
          }
        }, 
      }
    },
    collection_trxid_: {
      select:{
        created:true,
        creator_: {
          select:{
            userName:true,
            userID:true,
          }
        }, 
      }
    }
  },
})

//console.log(result)
 
      res.json({
        result: result,
        ids:ids,
      });
      
  }catch(error){
     next(error)
  }
})


app.post('/api/shipment_report_pickupid', async (req, res, next) => {
  try{

     const source = req.body.source
     const pickup_reference_id = req.body.pickup_reference_id
     const date = req.body.date
     const destination = req.body.destination
     const note = req.body.note
     const i_delivery_status_id_18 = req.body.i_delivery_status_id_18
 
      const Pickup = await prisma.pickup_tracking.findMany({
 
        where: {
          AND: [
              {
                i_delivery_status_id_18:i_delivery_status_id_18,
                ...(note ? { note:note } : {}),
                ...(destination ? { destination:destination } : {}),
                ...(date ? { date:date } : {}),
                ...(pickup_reference_id ? { pickup_reference_id:pickup_reference_id } : {}),
                ...(source ? { source:source } : {}),
              }
            ]
          },
        orderBy: {
            id: 'asc', 
        },

        include: {
          pickup_id_: {
            select:{
              i_priority_id_3:true,
            }
          }, 
        }
 
      })



      res.json({ 
        result: Pickup,
      }); 
      
  }catch(error){ 
     next(error)
  }
})



app.post('/api/shipment_report',auth, async (req, res, next) => {
  try{
 
     const source = req.body.source
     const destination=req.body.destination
     const i_delivery_status_id_18 = req.body.i_delivery_status_id_18
 
     const user_id=req.body.user_id 
     var unique=[]
     if(user_id>0){//so marchant
       const services_clients_branch = await prisma.services_clients_branch.findMany(
           {
             where: {  
               AND: [
                   {
                     ...(user_id > 0 ? { userID: user_id } : {}),
                   }
                 ]
               },
           }
           )
   
   
           if(user_id > 0){
             for(let i = 0; i < services_clients_branch.length; i++) {
               let obj = services_clients_branch[i];
               unique.push(obj.services_clients_id)
             }
           }
     }

     let groupBy=[]
if(destination || source){
    groupBy = await prisma.pickup_tracking.groupBy({
  by: ['pickup_reference_id','date','destination','source'],
  _count: {
    id: true,
  },
  where: {
    AND: [
        {
          i_delivery_status_id_18:i_delivery_status_id_18,
          ...(destination ? { destination: destination } : {}),  
          ...(source ? { source: source } : {}), 
        }
      ]
    },
  orderBy: {
      date: 'desc', 
  },
})
}



 

/*const groupBy2 = await prisma.pickup_tracking.groupBy({
  by: ['pickup_reference_id','date','destination','source'],
  _count: {
    id: true,
  },
  where: {
    AND: [
        {
          i_delivery_status_id_18:i_delivery_status_id_18,
          ...(source ? { source:source } : {}),
          note:'R'
        }
      ]
    },
  orderBy: {
      date: 'desc', 
  },
})*/



const branch = await prisma.branch.findMany()

      res.json({ 
        result: groupBy,
        branch:branch,
      }); 
      
  }catch(error){ 
     next(error)
  }
})
 


app.post('/api/pickup_report',auth, async (req, res, next) => {
  try{

 
      const created_branch_id = req.body.created_branch_id
      
      const user_id=req.body.user_id 
      var unique=[]
      if(user_id>0){//so marchant
        const services_clients_branch = await prisma.services_clients_branch.findMany(
            {
              where: {  
                AND: [
                    {
                      ...(user_id > 0 ? { userID: user_id } : {}),
                    }
                  ]
                },
            }
            )
    
    
            if(user_id > 0){
              for(let i = 0; i < services_clients_branch.length; i++) {
                let obj = services_clients_branch[i];
                unique.push(obj.services_clients_id)
              }
            }
      }

     

      const groupBy = await prisma.pickup.groupBy({
        take: 1200,
        by: ['unique_upload_id','pickup_date_3','services_id_1','created_branch_id','i_delivery_status_id_18','sender_client_id_7'],
        _count: {
          id: true,
        },
        where: { 
          NOT: {i_delivery_status_id_18:2},
          AND: [
              {
                ...(created_branch_id ? { created_branch_id: created_branch_id } : {}),
                ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}), 
              }
            ]
          },
        orderBy: {

          unique_upload_id: 'desc', 

        },
      })


      const branch  = await prisma.branch.findMany({select: { branch_id: true,branch: true, },})
      const services_clients = await prisma.services_clients.findMany(
        { select: {
          services_clients_id:true,
          services_clients: true, 
          },
        }
      )

      const services = await prisma.services.findMany({select: { services_id: true,services: true, },})
      const i_delivery_status = await prisma.i_delivery_status.findMany({select: { i_delivery_status_id: true,i_delivery_status: true, },})

            res.json({ 
              result:groupBy,
              i_delivery_status:i_delivery_status,
              services:services,
              branch:branch,
              services_clients:services_clients,
            }); 
            
        }catch(error){ 
          next(error)
        }
})
 

app.get('/api/get_shipment',auth, async (req, res) => {
  const shipment = await prisma.shipment.findMany()
  res.json({
    success: true,
    payload: shipment,
    message: "Operation Successful",
  })
})


    


    /*const general_customer = await prisma.pickup.findMany(
      {
        take: 1,
        orderBy: {
          
            id: 'desc',
          
        },
        where: {
          OR: [
            {
              sender_phone_5:req.body.phone,
            },
            {  recipient_phone_20:req.body.phone, },
          ]
         
        },
      }
    )*/

//payment


app.post('/api/delete_all',auth, async (req, res) => {

  try{

    console.log(req.body,'req.body')

const deletepickup_tracking = await prisma.pickup_tracking.deleteMany({
      where: {
        pickup_id: req.body.id,
      },
})
const deletepickup_  = await prisma.pickup.deleteMany({
      where: {
        id: req.body.id,
      },
})

 
    res.json({
      success: true,
       message: "Operation Successful", 
    })
    
  }catch(error){
    console.log(error)
     next(error)
  }
})




app.post('/api/insert_wallet',auth, async (req, res) => {

  try{
let bran=parseInt(req.branch)
    //[insert wallet]

 

    const user = await prisma.wallet_transaction.create({
      data: {
        transaction_id: req.body.transaction_id,
        amount: req.body.amount,
        key: req.body.key,
        method: req.body.method,
        account: req.body.account,
        marchant_id: req.body.marchant_id,
        client_id: req.body.client_id,
        request_date: req.body.request_date,
        created: req.body.created,
        creator: req.body.creator,
        approved_by: null,
        approved_date: req.body.approved_date,
        invoices:req.body.invoices,
        branch:bran
      },
    })



if(req.body.key!='withdraw'){
          //previous balance
              const prev_bal = await prisma.services_clients_branch.findMany(
                {
                  where: {
                    services_clients_branch_id: req.body.marchant_id,
                  },
                }
              )


          if(req.body.key=='paid'){
            var amt=prev_bal[0].wallet-req.body.amount
          }else{
            var amt=prev_bal[0].wallet+req.body.amount
          }

              
              //[update services branch]
              const update_walet = await prisma.services_clients_branch.updateMany({
                where: {
                  services_clients_branch_id: req.body.marchant_id,
                },
                data: {
                  wallet:amt,
                },
              })
}

    


    res.json({
      success: true,
      message: "Operation Successful", 
    })
    
  }catch(error){
    console.log(error)
     next(error)
  }
})




//update pickup
app.post('/api/update_pickup_walet',auth, async (req, res) => {

  try{

    console.log(req.body,'req.body')

    let trxid = req.body.trxid.toString()
    const updateUsers = await prisma.pickup.updateMany({
      where: {
        id: req.body.id,
      },
      data: {
        ...(req.body.type=="send" ? {  amount_to_wallet:req.body.amount_to_wallet, collection_trxid:trxid } : {}), 
        ...(req.body.type=="paid" ? {  amount_from_wallet:req.body.amount_to_wallet, charge_trxid:trxid } : {}), 
      },
    })

 
    res.json({
      success: true,
      type:req.body.type,
      amount_to_wallet:req.body.amount_to_wallet,
      message: "Operation Successful", 
    })
    
  }catch(error){
    console.log(error)
     next(error)
  }
})


app.post('/api/get_transaction',auth, async (req, res) => {

  try{
    var user_id=req.body.user_id 
    var unique=[]
    if(user_id>0){//so marchant
      const services_clients_branch = await prisma.services_clients_branch.findMany(
          {
            where: {  
              AND: [
                  {
                    ...(user_id > 0 ? { userID: user_id } : {}),
                  }
                ]
              },
          }
          )
  
  
          if(user_id > 0){
            for(let i = 0; i < services_clients_branch.length; i++) {
              let obj = services_clients_branch[i];
              unique.push(obj.services_clients_branch_id)
            }
          }
    }


    var range_start=req.body.range_start
    var range_end=req.body.range_end

    const result = await prisma.wallet_transaction.findMany(
      {
        orderBy: {
          
            id: 'desc',
          
        },
      where: {
        ...(unique.length>0 ? {  marchant_id: { in:unique }, } : {}),   
        ...(req.body.mykey?  {  key: req.body.mykey , } : {}), 
        ...(req.body.trx_src?  {  transaction_id: req.body.trx_src , } : {}), 
        ...(req.body.client_id?  {  client_id: req.body.client_id , } : {}), 

        created: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},    

        },
      include: {
        client_id_: {
          select:{
            services_clients:true,
          }
        }, 
        marchant_id_: {
          select:{
            services_clients_branch:true,
            wallet:true,
          }
        }, 
        creator_: {
          select:{
            userName:true,
            userID:true,
          }
        }, 
        approved_by2_: {
          select:{
            userName:true,
            userID:true,
          }
        },         
        current_branch: {
          select:{
            branch:true,
          }
        },
      },
      }
    )
    
    res.json({
      hh:req.body.user_id,
     unique:unique,

      success: true,
      result:result,
      message: "Operation Successful2", 
    })
    
  
  }catch(error){
     next(error)
  }
})



app.post('/api/insert_wallet_request', async (req, res) => {

  try{
    //[insert wallet]
    const user = await prisma.wallet_transaction.create({
      data: {
        transaction_id: req.body.transaction_id,
        amount: req.body.amount,
        key: req.body.key,
        method: req.body.method,
        account: req.body.account,
        marchant_id: req.body.marchant_id,
        client_id: req.body.client_id,
        request_date: req.body.request_date,
        created: req.body.created,
        creator: req.body.creator,
        approved_by: req.body.approved_by,
        approved_date: req.body.approved_date,
      },
    })


   

    let insert_wallet_request=req.body.selected_rows_text
    const myArray = insert_wallet_request.split(",");

    for (let i=0; i<myArray.length; i++){
          const update_walet_ok = await prisma.wallet_transaction.updateMany({
            where: {
              id: parseInt(myArray[i]),
            },
            data: {
              disbursed_trx:req.body.transaction_id,
              is_disbursed:1
            },
          })
    }


    res.json({
      success: true,
      message: "Operation Successful", 
    })
    
  }catch(error){
    console.log(error)
     next(error)
  }
})



app.post('/api/approved_pickup_wallet', async (req, res) => {

              try{
              const prev_bal = await prisma.services_clients_branch.findMany(
                {
                  where: {
                    services_clients_branch_id: req.body.marchant_id,
                  },
                }
              )


             var amt=0
              if(req.body.key=='withdraw'){
                 amt=prev_bal[0].wallet-req.body.amount_to_wallet
              }else{
                 amt=prev_bal[0].wallet+req.body.amount_to_wallet
              }


                //[update services branch]
               const update_walet = await prisma.services_clients_branch.updateMany({
                where: {
                  services_clients_branch_id: req.body.marchant_id,
                },
                data: {
                  wallet:amt,
                },
              })


              //[update services branch]
            const wallet_transaction = await prisma.wallet_transaction.updateMany({
              where: {
                id: req.body.id,
              },
              data: {
                approved_by: req.body.user,
                approved_date: req.body.date,
              },
            })


    res.json({
      success: update_walet,
      amt:amt,
      user:req.body.user,
      approved_date:req.body.date,
      id:req.body.id,
      message: "Operation Successful2", 
    })
    
  }catch(error){
     next(error)
  }
})

///////////////////////////////////////////////////

//issue
app.post('/api/post_issue',auth, async (req, res) => {
  try{
    const services_clients_issues = await prisma.services_clients_issues.createMany({
      data: req.body,
      skipDuplicates: true, 
    })

    res.json({
      success: true,
      result:services_clients_issues,
    })
    
  }catch(error){
     next(error)
  }
})


//issue reply
app.post('/api/post_issue_reply',  async (req, res) => {
  try{

  
    const services_clients_issues = await prisma.services_clients_issues.findUnique({
      where: {
        id: req.body.issue_id,
      },
    })

   var creator=services_clients_issues.creator
    var user_id=req.body.user_id
    var who

    if(creator==user_id){
      who = 'adm_new'
    }else{
       who = 'mar_new'
    }


    const updateUser = await prisma.services_clients_issues.update({
      where: {
        id: req.body.issue_id,
      },
      data: {
        reply: who,
      },
    }) 



    const services_clients_issues_reply = await prisma.services_clients_issues_reply.createMany({
      data: req.body,
      skipDuplicates: true, 
    })



    res.json({
      success: true,
      who:who,
      creator:creator,
      user_id:user_id,
       result:services_clients_issues_reply,
    })
    
  }catch(error){
     next(error)
  }
})

app.post('/api/get_issue_reply',  async (req, res) => {
  try{
    //var user_id=req.body.user_id 

    const wallet_transaction = await prisma.services_clients_issues_reply.updateMany({
      where: {

        NOT: [{ user_id: req.body.this_user},
        ],
        AND: [
          {
            issue_id: req.body.issue_id,
          },
        ], 
        
         
      }, 
      data: {
        is_seen:1,  
     
      },
    })  


    const result = await prisma.services_clients_issues_reply.findMany(
      {
        orderBy: {
            id: 'asc', 
        },
        where: {
          issue_id: req.body.issue_id, 
        }, 
        include:{
          user_:{
            select:{
              userName:true,
              userID:true,
            }
          }
        }
      }
    )
    
    res.json({
      success: true,
      result:result,
      message: "Operation Successful2", 
    })
    
  }catch(error){
     next(error)
  }
})



app.post('/api/get_issue',auth, async (req, res) => {
  try{
    var user_id=req.body.user_id 
    const result = await prisma.services_clients_issues.findMany(
      {
        orderBy: {
            id: 'desc', 
        },
      where: {
        ...(user_id>0 ? {  creator: user_id , } : {}), 
        ...(req.body.is_solved !=null? {  is_solved: req.body.is_solved , } : {}), 
        ...(req.body.is_seen !=null? {  is_seen: req.body.is_seen , } : {}), 

        is_delete:0, 
        }, 
      include: {
        creator_: {
          select:{
            userName:true,
            userID:true,
          }
        }, 
        reply_by_: {
          select:{
            userName:true,
            userID:true,
          }
        }, 
      },
      }
    )
    
    res.json({
      success: true,
      result:result,
      message: "Operation Successful2", 
    })
    
  }catch(error){
     next(error)
  }
})


app.post('/api/update_issues', async (req, res) => {

  try{
const wallet_transaction = await prisma.services_clients_issues.updateMany({
  where: {
    id: req.body.id,
  }, 
  data: {
    ...(req.body.is_solved ? {  is_solved:req.body.is_solved, } : {}), 
    ...(req.body.is_seen ? {  is_seen:req.body.is_seen, } : {}), 
    ...(req.body.reply_by ? {  reply_by:req.body.reply_by, } : {}), 
    ...(req.body.replied ? {  replied:req.body.replied, } : {}), 
    ...(req.body.is_delete ? {  is_delete:req.body.is_delete, } : {}), 
 
  },
})


res.json({
success: wallet_transaction,
message: "Operation Successful2", 
})

}catch(error){
next(error)
}
})



app.post('/api/get_tracking_all', async (req, res, next) => {
  try{

     const data = req.body
     var range_start=req.body.range_start
     var range_end=req.body.range_end
     let choice=req.body.choice
   
     let creator=req.body.delivery_boy_id
     const result = await prisma.pickup_tracking.findMany({
      where: {
            created: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   
            ...(choice ? { i_delivery_status_id_18: choice } : {}), 
            ...(creator ? { creator: creator } : {}),
      },
      include: {

        delivery_boy_id_: {
          select:{
            userName:true,
            userID:true,
            employee_id : true,
          }
        }, 
        i_relation: {
          select:{
            i_relation:true,
          }
        }, 
        i_return_cause: {
          select:{
            i_return_cause:true,
          }
        },

        i_delivery_status: {
          select:{
            i_delivery_status:true,
          }
        }, 
        i_tracking_status: {
          select:{
            i_tracking_status:true,
          }
        }, 
        branch_destination: {
          select:{
            branch:true,
          }
        }, 
        branch_source: {
          select:{
            branch:true,
          }
        },
        creator_:{
          select:{
            userName:true,
          }
          
        } 
      },

      })

      res.json({
        result: result,
      });



  }catch(error){
    next(error)
 }
})


////////////////////////////////////////////////////APP/////////////////
app.post('/api/testsum_app',auth, async (req, res) => {
  
  var range_start=req.body.range_start
  var range_end=req.body.range_end
  let delivery_boy_id=parseInt(req.body.delivery_boy_id)




const data = await prisma.pickup.groupBy({
  by: ['delivery_boy_id'],
  where: { i_delivery_status_id_18:6,

  delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},
  
  delivery_boy_id: delivery_boy_id   }, 
 
  _sum: { 
    amount_from_wallet: true,
    amount_to_wallet: true,
    delivery_cost_amount: true,
    cod_cost_amount: true,
    collection_amount: true,
    return_cost_amount: true,
  },
})
 

const processing = await prisma.pickup.count({ where:{       delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),      i_delivery_status_id_18:3 },     })
const shipped = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),     i_delivery_status_id_18:4 }, })
const in_transit = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    i_delivery_status_id_18:5 }, })
const hold = await prisma.pickup.count({ where: {       delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    i_delivery_status_id_18:9 }, })
const return_process = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),     i_delivery_status_id_18:7 }, })
const booking = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),   i_delivery_status_id_18:2 }, })
const out_for_deli = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    i_delivery_status_id_18:12 }, })
const exception = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    i_delivery_status_id_18:10 }, })
const delivered = await prisma.pickup.count({ where: {       delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),}, ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    i_delivery_status_id_18:6 }, })
const return_received = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    i_delivery_status_id_18:8 }, })




res.json({
      ...data[0]?._sum || 0, 
      processing:processing,
      shipped:shipped,
      in_transit:in_transit,
      hold:hold,
      return_process:return_process,
      booking:booking,
      out_for_deli:out_for_deli,
      exception:exception,
      delivered:delivered,
      return_received:return_received,
    } 
 ); 
})


app.post('/api/delivery_boy_repo', async (req, res) => {
  
  var range_start=req.body.range_start
  var range_end=req.body.range_end
  let delivery_boy_id=req.body.delivery_boy_id


    const delivery_boy =   await prisma.tbl_users.findMany({
            where: {
               userType: 15,
        },
         select: 
          { userID:true,
            userName: true,
            employee_id : true,
          },
        
    }
    )

const data = await prisma.pickup.groupBy({
  by: ['delivery_boy_id','i_delivery_status_id_18'],
  where: {   
			delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},
			...(delivery_boy_id ? { delivery_boy_id: parseInt(delivery_boy_id) } : {}),
		 },  
 
  _count: { 
    id: true,
  },
  
})
 

/*const processing = await prisma.pickup.count({ where:{       delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),      i_delivery_status_id_18:3 },     })
const shipped = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),     i_delivery_status_id_18:4 }, })
const in_transit = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    i_delivery_status_id_18:5 }, })
const hold = await prisma.pickup.count({ where: {       delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    i_delivery_status_id_18:9 }, })
const return_process = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),     i_delivery_status_id_18:7 }, })
const booking = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},   ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),   i_delivery_status_id_18:2 }, })
const out_for_deli = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    i_delivery_status_id_18:12 }, })
const exception = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    i_delivery_status_id_18:10 }, })
const delivered = await prisma.pickup.count({ where: {       delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),}, ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    i_delivery_status_id_18:6 }, })
const return_received = await prisma.pickup.count({ where: {      delivery_boy_date: { ...(range_end ? { lte: range_end } : {}),  ...(range_start ? { gte: range_start } : {}),},  ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),    i_delivery_status_id_18:8 }, })
*/



res.json({
	data:data,
	delivery_boy:delivery_boy
     /* ...data[0]?._sum || 0, 
      processing:processing,
      shipped:shipped,
      in_transit:in_transit,
      hold:hold,
      return_process:return_process,
      booking:booking,
      out_for_deli:out_for_deli,
      exception:exception,
      delivered:delivered,
      return_received:return_received,*/
    } 
 ); 
})




app.post('/api/pickup-query-app', async (req, res) => {

  try{

    const data = req.body
console.log(data)

    var current_branch_id=req.body.current_branch_id
    const services_id_1=req.body.services_id_1
    const i_product_type_id_2=req.body.i_product_type_id_2
    const i_payment_type_8=req.body.i_payment_type_8
    const creator=req.body.creator

	const pickup_id=req.body.id

 
    const delivery_boy_id=req.body.delivery_boy_id
 
    



    var pickup_ids=[]
    const shipment_ref=req.body.shipment_ref

     


    if(shipment_ref){
       //get all pickup id from tracking
         

           const pickup_tracking = await prisma.pickup_tracking.findMany(
               {
                 where: {  
                   AND: [
                       {
                         pickup_reference_id: shipment_ref,
                       }
                     ]
                   },
               }
               )
       
       
               if(pickup_tracking){
                 for(let i = 0; i < pickup_tracking.length; i++) {
                   let obj = pickup_tracking[i];
                   pickup_ids.push(obj.pickup_id)
                 }
                  current_branch_id=null
               }
              
    }



    const sender_category_1=req.body.sender_category_1


    const delivery_boy_date=req.body.delivery_boy_date
    const sender_phone_5=req.body.sender_phone_5
    const sender_client_id_7=req.body.sender_client_id_7
    const sender_client_branch_id_8=req.body.sender_client_branch_id_8
    const recipient_category_14=req.body.recipient_category_14
    const delivery_type_15=req.body.delivery_type_15
    const i_shipment_method_id_17=req.body.i_shipment_method_id_17
    let i_delivery_status_id_18=req.body.delivery_status 

    if(i_delivery_status_id_18){
      const yyy = await prisma.i_delivery_status.findMany(
        {
          where: {  
            AND: [
                {
                  i_delivery_status: i_delivery_status_id_18,
                }
              ]
            },
        }
        )

        if(yyy?.length>0){
            i_delivery_status_id_18=yyy[0].i_delivery_status_id
        }else{
          res.status(201).json({message:"Invalid Delivery Status Name"});
        }
       
    }




    const i_tracking_status_id_19=req.body.i_tracking_status_id_19
    const recipient_client_id_22=req.body.recipient_client_id_22
    const recipient_client_branch_id_23=req.body.recipient_client_branch_id_23
    const sender_ref_no_4=req.body.reference_no


    let have_mul_ref=0
    let _mul=[]
    if(sender_ref_no_4){

         _mul = sender_ref_no_4.split(" ") 
         if(_mul.length>1){
           have_mul_ref=1
         }
         
    }

   


    const recipient_phone_20=req.body.recipient_phone_20

    const charge_trxid=req.body.charge_trxid
    const collection_trxid=req.body.collection_trxid


    var range_start=req.body.range_start
    var range_end=req.body.range_end
    const unique_upload_id=req.body.unique_upload_id
    

let rowsPerPagex=req.body.rows_per_page || '10'
let pagex=req.body.page_no || '1'

    const take=parseInt(rowsPerPagex)
    const skip=parseInt(pagex-1)*parseInt(rowsPerPagex)
    

    const user_id=req.body.user_id
    const is_marchant=req.body.is_marchant

   const assign_date=null
    let checked_pickup=req.body.checked_pickup

let range_filter=req.body.range_filter || 'pickup_date_wise'

if(range_filter=='pickup_date_wise'){
  checked_pickup=true
}else{
  checked_pickup=false
}

   var range_start_assign=null
   var range_end_assign=null

   if(checked_pickup==true || checked_pickup==1 ){
       range_start_assign=null
       range_end_assign=null
   }else{ 
     range_start_assign=range_start
     range_end_assign=range_end
 
   } 


   // const user_id=req.body.user_id 

    var unique=[]
    if(user_id>0){//so marchant
     current_branch_id=null;
      const services_clients_branch = await prisma.services_clients_branch.findMany(
          {
            where: {  
              AND: [
                  {
                    ...(user_id > 0 ? { userID: user_id } : {}),
                  }
                ]
              },
          }
          )
  
  
          if(user_id > 0){
            for(let i = 0; i < services_clients_branch.length; i++) {
              let obj = services_clients_branch[i];
              unique.push(obj.services_clients_id)
            }
          }
    }


    //creator=null  ...(creator ? { creator: creator } : {}),

    if(req.body.i_delivery_status_count!=null){
     i_delivery_status_id_18=req.body.i_delivery_status_count
    }

 



    const result = await prisma.pickup.findMany({
     ...(skip ? { skip: skip } : {}),
     ...(take ? { take: take } : {}),

     orderBy: {
            
       id: 'desc',
     
   },
 //...(delivery_boy_date ? { delivery_boy_date: delivery_boy_date } : {}),
 where: {
   AND: [
       {
         ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),
         ...(services_id_1 ? { services_id_1: services_id_1 } : {}),
         ...(i_product_type_id_2 ? { i_product_type_id_2: i_product_type_id_2 } : {}),
         ...(i_payment_type_8 ? { i_payment_type_8: i_payment_type_8 } : {}),
       
         ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}), 
        
         ...(pickup_ids.length>0 ? {  id: { in:pickup_ids }, } : {}), 
         ...(pickup_id? {  id: parseInt(pickup_id) } : {}),


         ...(unique_upload_id ? { unique_upload_id: unique_upload_id } : {}),
         ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),
         ...(sender_phone_5 ? { sender_phone_5: sender_phone_5 } : {}),
         ...(sender_client_id_7 ? { sender_client_id_7: sender_client_id_7 } : {}),
         ...(sender_client_branch_id_8 ? { sender_client_branch_id_8: sender_client_branch_id_8 } : {}),
     
         ...(charge_trxid ? { charge_trxid: charge_trxid } : {}),
         ...(collection_trxid ? { collection_trxid: collection_trxid } : {}),

         ...(i_shipment_method_id_17 ? { i_shipment_method_id_17: i_shipment_method_id_17 } : {}),
         ...(i_delivery_status_id_18 ? { i_delivery_status_id_18: i_delivery_status_id_18 } : {}),
         ...(i_tracking_status_id_19 ? { i_tracking_status_id_19: i_tracking_status_id_19 } : {}),
         ...(recipient_client_id_22 ? { recipient_client_id_22: recipient_client_id_22 } : {}),
         ...(recipient_client_branch_id_23 ? { recipient_client_branch_id_23: recipient_client_branch_id_23 } : {}),



         ...(have_mul_ref==1 ? { sender_ref_no_4: { in:_mul }, } : {
           ...(sender_ref_no_4 ? { sender_ref_no_4: sender_ref_no_4 } : {}),
         }),

         

         ...(recipient_phone_20 ? { recipient_phone_20: recipient_phone_20 } : {}),

       },
       
       {
       delivery_boy_date: {
         ...(range_end ? { lte: range_end } : {}),
         ...(range_start ? { gte: range_start } : {}),
        
       },
       }
 

     ]



   },

 include: {
   delivery_boy_id_: {
     select:{
       userName:true,
       userID:true,
       employee_id : true,
     }
   }, 
   i_relation: {
     select:{
       i_relation:true,
     }
   }, 
   i_return_cause: {
     select:{
       i_return_cause:true,
     }
   },
   services: {
     select:{
       services:true,
     }
   }, 
   i_product_type: {
     select:{
       i_product_type:true,
     }
   }, 
   i_priority: {
     select:{
       i_priority:true,
     }
   }, 
   i_payment_type: {
     select:{
       i_payment_type:true,
     }
   }, 
   i_packaging_type: {
     select:{
       i_packaging_type:true,
     }
   }, 
   i_shipment_method: {
     select:{
       i_shipment_method:true,
     }
   }, 
   i_delivery_status: {
     select:{
       i_delivery_status:true,
     }
   },
   i_tracking_status: {
     select:{
       i_tracking_status:true,
     }
   },
   current_branch: {
     select:{
       branch:true,
     }
   },
   created_branch_: {
     select:{
       branch:true,
     }
   },
   creator1_: {
     select:{
       userName:true,
     }
   }
 },
})





const counts_ = await prisma.pickup.count({
where: {
AND: [
   {
     ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),
     ...(services_id_1 ? { services_id_1: services_id_1 } : {}),
     ...(i_product_type_id_2 ? { i_product_type_id_2: i_product_type_id_2 } : {}),
     ...(i_payment_type_8 ? { i_payment_type_8: i_payment_type_8 } : {}),
     ...(sender_phone_5 ? { sender_phone_5: sender_phone_5 } : {}),
     ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),
     ...(sender_client_branch_id_8 ? { sender_client_branch_id_8: sender_client_branch_id_8 } : {}),
     ...(i_shipment_method_id_17 ? { i_shipment_method_id_17: i_shipment_method_id_17 } : {}),
     ...(i_delivery_status_id_18 ? { i_delivery_status_id_18: i_delivery_status_id_18 } : {}),
     ...(i_tracking_status_id_19 ? { i_tracking_status_id_19: i_tracking_status_id_19 } : {}),
     ...(recipient_client_id_22 ? { recipient_client_id_22: recipient_client_id_22 } : {}),
     ...(recipient_client_branch_id_23 ? { recipient_client_branch_id_23: recipient_client_branch_id_23 } : {}),

     ...(have_mul_ref==1 ? { sender_ref_no_4: { in:_mul }, } : {
       ...(sender_ref_no_4 ? { sender_ref_no_4: sender_ref_no_4 } : {}),
     }),

     ...(recipient_phone_20 ? { recipient_phone_20: recipient_phone_20 } : {}),
     ...(unique_upload_id ? { unique_upload_id: unique_upload_id } : {}),
     ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),
     ...(pickup_ids.length>0 ? {  id: { in:pickup_ids }, } : {}), 
	 ...(pickup_id? {  id: parseInt(pickup_id) } : {}), 

     ...(charge_trxid ? { charge_trxid: charge_trxid } : {}),
     ...(collection_trxid ? { collection_trxid: collection_trxid } : {}),
   },
   
   {
   delivery_boy_date: {
     ...(range_end ? { lte: range_end } : {}),
     ...(range_start ? { gte: range_start } : {}),
   },
   },
 
 ]
},
})


console.log({
  AND: [
     {
       ...(current_branch_id ? { current_branch_id: current_branch_id } : {}),
       ...(services_id_1 ? { services_id_1: services_id_1 } : {}),
       ...(i_product_type_id_2 ? { i_product_type_id_2: i_product_type_id_2 } : {}),
       ...(i_payment_type_8 ? { i_payment_type_8: i_payment_type_8 } : {}),
       ...(sender_phone_5 ? { sender_phone_5: sender_phone_5 } : {}),
       ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}),
       ...(sender_client_branch_id_8 ? { sender_client_branch_id_8: sender_client_branch_id_8 } : {}),
       ...(i_shipment_method_id_17 ? { i_shipment_method_id_17: i_shipment_method_id_17 } : {}),
       ...(i_delivery_status_id_18 ? { i_delivery_status_id_18: i_delivery_status_id_18 } : {}),
       ...(i_tracking_status_id_19 ? { i_tracking_status_id_19: i_tracking_status_id_19 } : {}),
       ...(recipient_client_id_22 ? { recipient_client_id_22: recipient_client_id_22 } : {}),
       ...(recipient_client_branch_id_23 ? { recipient_client_branch_id_23: recipient_client_branch_id_23 } : {}),
  
       ...(have_mul_ref==1 ? { sender_ref_no_4: { in:_mul }, } : {
         ...(sender_ref_no_4 ? { sender_ref_no_4: sender_ref_no_4 } : {}),
       }),
  
       ...(recipient_phone_20 ? { recipient_phone_20: recipient_phone_20 } : {}),
       ...(unique_upload_id ? { unique_upload_id: unique_upload_id } : {}),
       ...(delivery_boy_id ? { delivery_boy_id: delivery_boy_id } : {}),
       ...(pickup_ids.length>0 ? {  id: { in:pickup_ids }, } : {}), 
  
       ...(charge_trxid ? { charge_trxid: charge_trxid } : {}),
       ...(collection_trxid ? { collection_trxid: collection_trxid } : {}),
     },
     
     {
     delivery_boy_date: {
       ...(range_end ? { lte: range_end } : {}),
       ...(range_start ? { gte: range_start } : {}),
     },
     },
   
   ]
  })

 

let result_col=[]
for(var i=0; i<result?.length; i++){
  let ob=result[i]

let sms_con=ob.i_sms_template_id_30
 
let sms_active=0
if(sms_con){
	let arr=sms_con.split(",")
	if(arr.includes("5")){
	    sms_active=1
	}
}

    result_col.push({
      "pickup_id" : ob.id,
      pickup_date: ob.delivery_boy_date,
      reference_no: ob.sender_ref_no_4,
      recipient_name:ob.recipient_name_21,
      recipient_phone:ob.recipient_phone_20,
      recipient_address:ob.recipient_address_24,
 
    
      delivery_date:ob.delivery_date || "",

      collection_amount: ob.collection_amount,
      settlement:ob.amount_to_wallet || 0,
 
      services:ob.services.services,
      product_type:ob.i_product_type.i_product_type,
      priority:ob.i_priority.i_priority,
      payment_type:ob.i_payment_type.i_payment_type,
      delivery_status:ob.i_delivery_status.i_delivery_status,
	  otp_verify: ob.otp_verified || 0,
		sms_active:sms_active,
      tracking_status:ob.i_tracking_status.i_tracking_status,
      current_branch:ob.current_branch.current_branch
    })
}  



 
     res.json({ 
      counts_:counts_,
      rows_per_page:rowsPerPagex,
      page_no:pagex,
      result: result,
      result:result_col,
     });
     
 }catch(error){ 
    //next(error)
    
    console.log(error,'111')
    res.json(error);
 }
})





app.post('/api/create_pickup_tracking_app', async (req, res, next) => {
  try{

    //insert
     const data = req.body
    // console.log(data,'data')

	
 
	
	let x_created=req.body.formattedDate;
	let x_date=req.body.formattedDate;
	let x_time=req.body.formattedDateT;
	
	let x_creator=parseInt(req.body.delivery_boy_id);
	let pickup_id=parseInt(req.body.pickup_id);
	let i_relation_id=parseInt(req.body.i_relation_id);
	
	
 
			  
			   let findtrac = await prisma.pickup.findFirst({
                where: {
                  id:data.id
                },
                orderBy: {
                  id: "desc"
                },
				 include: {
				   i_product_type: {
					 select:{
					   i_product_type:true,
					 }
				   }, 
				 }
				
              })
			  
			  console.log(findtrac)
			  
			  
			if(findtrac.i_delivery_status_id_18!=6)  {
				
				  
			  console.log(findtrac)
	let x_source=findtrac.current_branch_id;
	let x_destination=findtrac.current_branch_id;
	
	let sms_con=findtrac.i_sms_template_id_30
 
	let sms_active=0
	if(sms_con){
		let arr=sms_con.split(",")
		if(arr.includes("4")){
			sms_active=1
			//delivery sms
			
						  var msg_get =  'Your '+findtrac.i_product_type.i_product_type+', REF:' + findtrac.sender_ref_no_4+'  is delivered. Thanks iXpress Ltd'

							let pickup_sms_collection=[]

                        var this_msg = {
                            to : findtrac.recipient_phone_20,    
                            message : msg_get 
                          };
                        pickup_sms_collection.push(this_msg);
						
						console.log(pickup_sms_collection)
						
				      const requestOptions = {
                              method: 'POST',
                              mode: 'no-cors',
                              headers: { 
                                "content-type": "application/json"
                              },
                              body: JSON.stringify(pickup_sms_collection)
                          };
                          console.log(requestOptions,'requestOptions')

                          fetch('http://159.223.76.11/bulk_sms_api.php', requestOptions)
                          .then(data =>console.log(data) ); 
				
			
			
			
			
		}
	}


	let obj_ready={
			"pickup_id": pickup_id,
			"i_relation_id": i_relation_id,
			"pickup_reference_id": req.body.pickup_reference_id,
			"i_relation_person": req.body.i_relation_person,
			"i_delivery_status_id_18": 6,
			"i_tracking_status_id_19": 2,	
			"action_type": "deliverd_to_recipient",
			"i_return_cause_id": null,
			"note": 'R',
			
		    "creator": x_creator,
			"created": x_created,
			"date": x_date,
			"time": x_time,

			"delivery_boy_id": x_creator,
			"source": x_source,
			"destination": x_destination,
	}
	
	console.log('obj_ready',obj_ready);
	
      const createMany = await prisma.pickup_tracking.createMany({
        data: obj_ready ,
        skipDuplicates: true, 
      })
 
    
          var time = x_time
          let date2_ = x_date;


         if(time){
            const myArray = time.split(":");
           
         var hours = myArray[0];
         var minutes = myArray[1];
         var ampm = hours >= 12 ? 'pm' : 'am';
         hours = hours % 12;
         hours = hours ? hours : 12; // the hour '0' should be '12'
         minutes = minutes < 10 ? '0'+minutes : minutes;
         var strTime = hours + ':' + minutes + ' ' + ampm;
         time= strTime;   
          } 
			 
           const updatePickup = await prisma.pickup.update({
            where: {
              id: pickup_id,
            },
            data: {
				i_tracking_status_id_19:2,
               i_delivery_status_id_18: 6,
               delivery_boy_id: x_creator,
               delivery_boy_date: x_date,
               i_relation_person: req.body.i_relation_person,
               i_relation_id: i_relation_id,
               delivery_date: x_date+" "+time, 
            },
          })

     console.log('updatePickup',{
               i_delivery_status_id_18: 6,
               delivery_boy_id: x_creator,
               delivery_boy_date: x_date,
               i_relation_person: req.body.i_relation_person,
               i_relation_id: i_relation_id,
               delivery_date: x_date+" "+time, 
            });
 
				
			}
			  
			  
			

          res.json({
            result:'success',
      });
  
      
  }catch(error){
     next(error)
  }
})











app.post('/api/set_otp_db_app',auth, async (req, res, next) => {
  try{

     const data = req.body
 
 const otp = Math.floor(Math.random() * 9000 + 1000);

	         let findtrac = await prisma.pickup.findFirst({
                where: {
                  id:data.id
                },
                orderBy: {
                  id: "desc"
                },
				 include: {
				   i_product_type: {
					 select:{
					   i_product_type:true,
					 }
				   }, 
				 }
				
              })
			  var pickup_sms_collection=[]
			if(findtrac.otp>0)  {
				
				
 res.status(201).json({message:"Already send"});
				
				
			} else{
				///sms to findtrac.recipient_phone_20
				      var msg_get =  otp.toString() + ' is OTP for delivery your '+findtrac.i_product_type.i_product_type+', REF:' + findtrac.sender_ref_no_4 + '. Thanks iXpress Ltd'

                        var this_msg = {
                            to : findtrac.recipient_phone_20,    
                            message : msg_get 
                          };
                        pickup_sms_collection.push(this_msg);
						
						console.log(pickup_sms_collection)
						
				      const requestOptions = {
                              method: 'POST',
                              mode: 'no-cors',
                              headers: { 
                                "content-type": "application/json"
                              },
                              body: JSON.stringify(pickup_sms_collection)
                          };
                          console.log(requestOptions,'requestOptions')

                          fetch('http://159.223.76.11/bulk_sms_api.php', requestOptions)
                          .then(data =>console.log(data) ); 
				
				
					 const updateUser = await prisma.pickup.update({
					  where: {
						id:data.id
					  },
					  data: {
						otp: otp,
					  },
					})				
			}


      res.json({
        result: 0,
      });



  }catch(error){
    next(error)
 }
})






app.post('/api/create_pickup_ex_tracking_app', async (req, res, next) => {
  try{

    //insert
     const data = req.body
    console.log('9999999999999999999999999999999999999999999')

	let x_created=req.body.formattedDate;
	let x_date=req.body.formattedDate;
	let x_time=req.body.formattedDateT;
	
	let x_creator=parseInt(req.body.delivery_boy_id);
	let pickup_id=parseInt(req.body.pickup_id);
 	let i_tracking_status_id_19=parseInt(req.body.i_return_cause_id);
	let i_return_cause_id=parseInt(req.body.i_tracking_status_id_19);

	         let findtrac = await prisma.pickup.findFirst({
                where: {
                  id:pickup_id
                },
                orderBy: {
                  id: "desc"
                }
              })
			  
			if(findtrac.i_delivery_status_id_18!=10)  {
				
				  
			  console.log(findtrac)
	let x_source=findtrac.current_branch_id;
	let x_destination=findtrac.current_branch_id;
	
	let obj_ready={
			"pickup_id": pickup_id,
	 
			"pickup_reference_id": req.body.pickup_reference_id,
 			"i_delivery_status_id_18": 10,
			"i_tracking_status_id_19": i_tracking_status_id_19,	
			"action_type": "others",
			"i_return_cause_id": i_return_cause_id,
		 
			
		    "creator": x_creator,
			"created": x_created,
			"date": x_date,
			"time": x_time,

			"delivery_boy_id": x_creator,
			"source": x_source,
			"destination": x_destination,
	}
	
	console.log('obj_ready',obj_ready);
	
      const createMany = await prisma.pickup_tracking.createMany({
        data: obj_ready ,
        skipDuplicates: true, 
      })
 
    
          var time = x_time
          let date2_ = x_date;


         if(time){
            const myArray = time.split(":");
           
         var hours = myArray[0];
         var minutes = myArray[1];
         var ampm = hours >= 12 ? 'pm' : 'am';
         hours = hours % 12;
         hours = hours ? hours : 12; // the hour '0' should be '12'
         minutes = minutes < 10 ? '0'+minutes : minutes;
         var strTime = hours + ':' + minutes + ' ' + ampm;
         time= strTime;   
          } 
			 
           const updatePickup = await prisma.pickup.update({
            where: {
              id: pickup_id,
            },
            data: {
			i_tracking_status_id_19:i_tracking_status_id_19,
               i_delivery_status_id_18: 10,
               delivery_boy_id: x_creator,
               delivery_boy_date: x_date,             
               delivery_date: x_date+" "+time, 
            },
          })

 
 
				
			}
			  
			  
			

          res.json({
            result:'success',
      });
  
      
  }catch(error){
     next(error)
  }
})





app.get('/api/pickup-tracking-single', async (req, res) => {

  try{

    const data = req.body

    var current_branch_id=req.body.current_branch_id
    const services_id_1=req.body.services_id_1
    const i_product_type_id_2=req.body.i_product_type_id_2
    const i_payment_type_8=req.body.i_payment_type_8
    const creator=req.body.creator

 

    var delivery_boy_id
    if(req.body.is_delivery_boy==1){
     delivery_boy_id=req.body.user_id
    }else{
     delivery_boy_id=req.body.delivery_boy_id
    }
    



    var pickup_ids=[]
    const shipment_ref=req.body.shipment_ref

     


    if(shipment_ref){
       //get all pickup id from tracking
         

           const pickup_tracking = await prisma.pickup_tracking.findMany(
               {
                 where: {  
                   AND: [
                       {
                         pickup_reference_id: shipment_ref,
                       }
                     ]
                   },
               }
               )
       
       
               if(pickup_tracking){
                 for(let i = 0; i < pickup_tracking.length; i++) {
                   let obj = pickup_tracking[i];
                   pickup_ids.push(obj.pickup_id)
                 }
                  current_branch_id=null
               }
              
    }



    const sender_category_1=req.body.sender_category_1


    const pickup_date_3=req.body.pickup_date_3
    const sender_phone_5=req.body.sender_phone_5
    const sender_client_id_7=req.body.sender_client_id_7
    const sender_client_branch_id_8=req.body.sender_client_branch_id_8
    const recipient_category_14=req.body.recipient_category_14
    const delivery_type_15=req.body.delivery_type_15
    const i_shipment_method_id_17=req.body.i_shipment_method_id_17
    let i_delivery_status_id_18=req.body.delivery_status 

    if(i_delivery_status_id_18){
      const yyy = await prisma.i_delivery_status.findMany(
        {
          where: {  
            AND: [
                {
                  i_delivery_status: i_delivery_status_id_18,
                }
              ]
            },
        }
        )

        if(yyy?.length>0){
            i_delivery_status_id_18=yyy[0].i_delivery_status_id
        }else{
          res.status(201).json({message:"Invalid Delivery Status Name"});
        }
       
    }




    const i_tracking_status_id_19=req.body.i_tracking_status_id_19
    const recipient_client_id_22=req.body.recipient_client_id_22
    const recipient_client_branch_id_23=req.body.recipient_client_branch_id_23
    const sender_ref_no_4=req.body.reference_no


	
	try {
		  if(sender_ref_no_4.length>2){
			  
		  }else{
				res.status(500).json({message:"Invalid Request"});
		  }
 
	} catch (error) {
	  res.status(500).json({message:"Invalid Request"});
	} 
	


    let have_mul_ref=0
    let _mul=[]
    if(sender_ref_no_4){

         _mul = sender_ref_no_4.split(" ") 
         if(_mul.length>1){
           have_mul_ref=1
         }
         
    }else{
		
	}
	

	



    const recipient_phone_20=req.body.recipient_phone_20

    const charge_trxid=req.body.charge_trxid
    const collection_trxid=req.body.collection_trxid


    var range_start=req.body.range_start
    var range_end=req.body.range_end
    const unique_upload_id=req.body.unique_upload_id
    

let rowsPerPagex=req.body.rows_per_page || '10'
let pagex=req.body.page_no || '1'

    const take=parseInt(rowsPerPagex)
    const skip=parseInt(pagex-1)*parseInt(rowsPerPagex)
    

    const user_id=req.body.user_id
    const is_marchant=req.body.is_marchant

   const assign_date=null
    let checked_pickup=req.body.checked_pickup

let range_filter=req.body.range_filter || 'pickup_date_wise'

if(range_filter=='pickup_date_wise'){
  checked_pickup=true
}else{
  checked_pickup=false
}

   var range_start_assign=null
   var range_end_assign=null

   if(checked_pickup==true || checked_pickup==1 ){
       range_start_assign=null
       range_end_assign=null
   }else{ 
     range_start_assign=range_start
     range_end_assign=range_end
     
     range_end=null
     range_start=null
   } 


   // const user_id=req.body.user_id 

    var unique=[]
    if(user_id>0){//so marchant
     current_branch_id=null;
      const services_clients_branch = await prisma.services_clients_branch.findMany(
          {
            where: {  
              AND: [
                  {
                    ...(user_id > 0 ? { userID: user_id } : {}),
                  }
                ]
              },
          }
          )
  
  
          if(user_id > 0){
            for(let i = 0; i < services_clients_branch.length; i++) {
              let obj = services_clients_branch[i];
              unique.push(obj.services_clients_id)
            }
          }
    }


    //creator=null  ...(creator ? { creator: creator } : {}),

    if(req.body.i_delivery_status_count!=null){
     i_delivery_status_id_18=req.body.i_delivery_status_count
    }

 

    const result = await prisma.pickup.findMany({
     ...(skip ? { skip: skip } : {}),
     ...(take ? { take: take } : {}),

     orderBy: {
            
       id: 'desc',
     
   },
 //...(pickup_date_3 ? { pickup_date_3: pickup_date_3 } : {}),
 where: {
   AND: [
       {
        
         ...(unique.length>0 ? {  sender_client_id_7: { in:unique }, } : {}), 
        
         ...(pickup_ids.length>0 ? {  id: { in:pickup_ids }, } : {}), 
         


          ...(charge_trxid ? { charge_trxid: charge_trxid } : {}),
         ...(collection_trxid ? { collection_trxid: collection_trxid } : {}),

          ...(i_tracking_status_id_19 ? { i_tracking_status_id_19: i_tracking_status_id_19 } : {}),
         ...(recipient_client_id_22 ? { recipient_client_id_22: recipient_client_id_22 } : {}),
         ...(recipient_client_branch_id_23 ? { recipient_client_branch_id_23: recipient_client_branch_id_23 } : {}),



         ...(have_mul_ref==1 ? { sender_ref_no_4: { in:_mul }, } : {
           ...(sender_ref_no_4 ? { sender_ref_no_4: sender_ref_no_4 } : {}),
         }),

         

         ...(recipient_phone_20 ? { recipient_phone_20: recipient_phone_20 } : {}),

       },
       
       {
       pickup_date_3: {
         ...(range_end ? { lte: range_end } : {}),
         ...(range_start ? { gte: range_start } : {}),
        
       },
       }

       ,
       {
         delivery_boy_date: {
         ...(range_start_assign ? { lte: range_start_assign } : {}),
         ...(range_end_assign ? { gte: range_end_assign } : {}),
       },
       }

     ]



   },

 include: {
   delivery_boy_id_: {
     select:{
       userName:true,
       userID:true,
       employee_id : true,
     }
   }, 
   i_relation: {
     select:{
       i_relation:true,
     }
   }, 
   i_return_cause: {
     select:{
       i_return_cause:true,
     }
   },
   services: {
     select:{
       services:true,
     }
   }, 
   i_product_type: {
     select:{
       i_product_type:true,
     }
   }, 
   i_priority: {
     select:{
       i_priority:true,
     }
   }, 
   i_payment_type: {
     select:{
       i_payment_type:true,
     }
   }, 
   i_packaging_type: {
     select:{
       i_packaging_type:true,
     }
   }, 
   i_shipment_method: {
     select:{
       i_shipment_method:true,
     }
   }, 
   i_delivery_status: {
     select:{
       i_delivery_status:true,
     }
   },
   i_tracking_status: {
     select:{
       i_tracking_status:true,
     }
   },
   current_branch: {
     select:{
       branch:true,
     }
   },
   created_branch_: {
     select:{
       branch:true,
     }
   },
   creator1_: {
     select:{
       userName:true,
     }
   }
 },
})



/*recipient: 
      {
        name:ob.recipient_name_21,
        phone:ob.recipient_phone_20,
        address:ob.recipient_address_24,
      },*/
 
 
let result_col=[]
for(var i=0; i<1; i++){
  let ob=result[i]

    result_col.push({
      "pickup_id" : ob.id,
      pickup_date: ob.pickup_date_3,
      reference_no: ob.sender_ref_no_4,
      

      collection_amount: 
      {
        total:ob.collection_amount,
        settlement:ob.amount_to_wallet || 0
      },
 
      services:ob.services.services,
      product_type:ob.i_product_type.i_product_type,
      priority:ob.i_priority.i_priority,
      payment_type:ob.i_payment_type.i_payment_type,
      delivery_status:ob.i_delivery_status.i_delivery_status,
      ...(ob.i_delivery_status.i_delivery_status=='Delivered' ? { otp_verify: ob.otp_verified || '0' } : {}),
      tracking_status:ob.i_tracking_status.i_tracking_status,
      current_branch:ob.current_branch.current_branch
    })
}  

let tresult=[]
 


    /* const createMany = await prisma.pickup.createMany({
       data: req.body ,
       skipDuplicates: true, 
     })      result: result,*/
	 if(result_col?.length>0){
		 
		        tresult = await prisma.pickup_tracking.findMany({
      where: {
        pickup_id:parseInt(result_col[0].pickup_id)
      },
      select: {
		    pickup_id:true,
			action_type:true,
			date:true,
			time:true,
			 
			i_relation_person:true,
			
        delivery_boy_id_: {
          select:{
            userName:true  
          }
        }, 
        i_relation: {
          select:{
            i_relation:true,
          }
        }, 
        i_return_cause: {
          select:{
            i_return_cause:true,
          }
        },

        i_delivery_status: {
          select:{
            i_delivery_status:true,
          }
        }, 
        i_tracking_status: {
          select:{
            i_tracking_status:true,
          }
        }, 
        branch_destination: {
          select:{
            branch:true,
          }
        }, 
        branch_source: {
          select:{
            branch:true,
          }
        },
         
      },

      })
		 
		 
		res.status(200).json({ data:result_col[0], tracking:tresult, message:"Result Found"  }); 
	 }else{
		 res.status(404).json({ data:[],  tracking:[], message:"No Result  Found" });
	 }
     
     
 }catch(error){ 
    //next(error)
    res.status(500).json({message:"Invalid Request"});
 
 }
})




app.listen(4615,()=>{ console.log('ok');  })
    


